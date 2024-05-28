<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\Clients\CurrencyFromBank\CentralBankRussiaClient;
use DateTime;
use App\Services\CurrencyService;

class CurrencyServiceTest extends TestCase
{
    /**
     * @run ./vendor/bin/phpunit --testsuite=Unit --filter testCurrencyService
     */
    public function testCurrencyService(): void
    {
        // TODO: переписать на стандартные моки
        $service = new class() extends CurrencyService {
            protected function getClient() : CentralBankRussiaClient
            {
                return new class() extends CentralBankRussiaClient {
                    public function getForDay(DateTime $dateTime): string
                    {
                        return file_get_contents(__DIR__ . '/Clients/CurrencyFromBank/fixture/XML_daily.xml');
                    }
                };
            }
        };

        $this->assertTrue($service->sync());
    }
}
