<?php

namespace App\Services\Clients\CurrencyFromBank;

use DateTime;

interface CurrencyInterface
{
    public function getForDay(DateTime $dateTime): string;
}
