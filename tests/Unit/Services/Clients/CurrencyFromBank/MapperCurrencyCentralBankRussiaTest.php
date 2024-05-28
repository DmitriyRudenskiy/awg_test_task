<?php

namespace Tests\Unit\Services\Clients\CurrencyFromBank;

use PHPUnit\Framework\TestCase;
use App\Services\Clients\CurrencyFromBank\MapperCurrencyCentralBankRussia;


class MapperCurrencyCentralBankRussiaTest extends TestCase
{
    private string $xml;

    protected function setUp(): void
    {
        $this->xml = file_get_contents(__DIR__ . '/fixture/XML_daily.xml');
    }

    /**
     * @dataProvider provideCharCodesData
     * @run ./vendor/bin/phpunit --testsuite=Unit --filter testSimpleParseXml
     */
    public function testSimpleParseXml(int $count, array $charCodes): void
    {
        $service = new MapperCurrencyCentralBankRussia();
        $result = $service->parse($this->xml, $charCodes);

        $this->assertEquals($count, $result->count());
    }

    public function provideCharCodesData(): array
    {
        return [
            // у рубля нету курса
            [0, ['RUB']],
            [1, ['USD']],
            [1, ['RUB', 'USD']],
            [2, ['RUR', 'USD', 'EUR']],
            [3, ['RUR', 'USD', 'EUR', 'JPY']],
            [4, ['RUR', 'USD', 'EUR', 'JPY', 'CNY']],
        ];
    }
}
