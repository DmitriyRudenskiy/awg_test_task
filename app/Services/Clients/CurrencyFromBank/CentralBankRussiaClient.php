<?php

namespace App\Services\Clients\CurrencyFromBank;

use DateTime;
use Illuminate\Support\Facades\Http;

class CentralBankRussiaClient implements CurrencyInterface
{
    private const BASE_URL = 'http://www.cbr.ru';

    public function getForDay(DateTime $dateTime): string
    {
        $url = sprintf('%s/scripts/XML_daily.asp?date_req=%s', self::BASE_URL, $dateTime->format('d/m/Y'));
        $response = Http::get($url);

        if (! $response->successful()) {
            // TODO: написать пользовательское исключение
            throw new \RuntimeException('Error for url: '.$url);
        }

        return $response->body();
    }
}
