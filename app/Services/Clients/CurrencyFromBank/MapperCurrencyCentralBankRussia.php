<?php

namespace App\Services\Clients\CurrencyFromBank;

use ArrayIterator;
use SimpleXMLElement;
use App\Services\CurrencyService;

class MapperCurrencyCentralBankRussia
{
    private const INDEX_CHAR_CODE = 'CharCode';

    private const INDEX_VALUE = 'Value';

    public function parse(string $content, array $charCodes = []): ArrayIterator
    {
        $result = [];

        $content = mb_convert_encoding($content,  'windows-1251', 'utf-8');

        $document = new SimpleXMLElement($content);

        foreach ($document as $value) {
            $charCode = (string)$value->{self::INDEX_CHAR_CODE} ?? '';

            if (empty($charCodes) || in_array($charCode, $charCodes)) {

                $rawCurrencyValue = (string)$value->{self::INDEX_VALUE} ?? '';

                $currencyValue = (int)(
                    // TODO: петля вынести в интерфейс
                    CurrencyService::BASE_COEFFICIENT * round(
                        floatval(
                            str_replace(',', '.', $rawCurrencyValue)
                        ),
                        4
                    )
                );

                $result[] = [
                    'code' => $charCode,
                    'value' => $currencyValue,
                ];
            }
        }

        return new ArrayIterator($result);
    }
}
