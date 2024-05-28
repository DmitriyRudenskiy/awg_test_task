<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\CurrencyValue;
use App\Services\Clients\CurrencyFromBank\CentralBankRussiaClient;
use DateTime;
use App\Services\Clients\CurrencyFromBank\MapperCurrencyCentralBankRussia;
use Illuminate\Support\Facades\DB;

class CurrencyService
{
    private const BASE_COEFFICIENT = 10000;

    /**
     * Запускам работу сервера
     */
    public function sync(DateTime $datetime = null, array $listCurrency = []): bool
    {
        if ($datetime === null) {
            $datetime = new DateTime();
            $datetime->setTime(0,0);
        }

        if ($listCurrency === []) {
            $listCurrency = (new Currency())->pluck('char_code')->toArray();
        }

        $currencyValues = (new MapperCurrencyCentralBankRussia())->parse($this->getClient()->getForDay($datetime), $listCurrency);

        if ($currencyValues->count() === 0) {
            return false;
        }

        foreach ($currencyValues as $value) {
            $this->addRecord( $datetime, $value['code'], $value['value']);
        }

        return true;
    }

    protected function addRecord(DateTime $day, string $code, int $value): void
    {
        DB::transaction(function () use ($day, $code, $value) {
            $currency = (new Currency())->where('char_code', $code)->firstOrFail();

            $recordInHistory = (new CurrencyHistory())->where('currency_id', $currency->id)->orderBy('created_at')->first();

            if ($recordInHistory === null || $recordInHistory->created_at !== $day->format('Y-m-d')) {
                CurrencyHistory::create([
                    'currency_id' =>$currency->id,
                    'value' => $value,
                    'created_at' => $day,
                ]);
            }

            CurrencyValue::updateOrCreate(
                ['currency_id' => $currency->id],
                ['value' => $value, 'created_at' => $day]
            );
        });
    }

    /**
     * Получаем клиент для работы с курсами валют
     */
    protected function getClient() : CentralBankRussiaClient
    {
        return new CentralBankRussiaClient();
    }

    /**
     * Получаем курс валют на указанное время
     */
    public function get(string $charCode, DateTime $day)
    {
        $currency = DB::table('currency')
            ->join('currency_history', 'currency.id', '=', 'currency_history.currency_id')
            ->select('currency.char_code', 'currency_history.value')
            ->where('char_code', $charCode)
            ->where('currency_history.created_at', $day)
            ->orderBy('currency_history.created_at')
            ->first();

        if ($currency === null) {
            return null;
        }

        $currency->value /= self::BASE_COEFFICIENT;

        return $currency;
    }
}
