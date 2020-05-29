<?php

namespace Socloz\Recruitment\Tests\Ex1;

use Socloz\Recruitment\Ex1\Store;

class DataGenerator
{
    public static function generateStores(int $number): array
    {
        $stores = [];
        for ($i = 0; $i < $number; $i++) {
            $stores[] = new Store($i);
        }

        return $stores;
    }
}