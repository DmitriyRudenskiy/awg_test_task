<?php

namespace Tests\Unit\Services;

use App\Services\Clients\CurrencyFromBank\CentralBankRussiaClient;
use App\Services\CurrencyService;
use DateTime;
use Tests\TestCase;

class CurrencyServiceTest extends TestCase
{
    /**
     * @run ./vendor/bin/phpunit --testsuite=Unit --filter testCurrencyService
     */
    public function testCurrencyService(): void
    {
        // TODO: переписать на стандартные моки
        $service = new class() extends CurrencyService
        {
            protected function getClient(): CentralBankRussiaClient
            {
                return new class() extends CentralBankRussiaClient
                {
                    public function getForDay(DateTime $dateTime): string
                    {
                        return file_get_contents(__DIR__.'/Clients/CurrencyFromBank/fixture/XML_daily.xml');
                    }
                };
            }
        };

        $this->assertTrue($service->sync());
    }
}
