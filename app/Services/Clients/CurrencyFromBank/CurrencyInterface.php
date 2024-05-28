<?php

namespace App\Services\Clients\CurrencyFromBank;

use DateTime;
use ArrayIterator;

interface CurrencyInterface
{
    public function getForDay(DateTime $dateTime): string;
}
