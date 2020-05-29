<?php

namespace Socloz\Recruitment\Tests\Ex1;

use PHPUnit\Framework\TestCase;
use Socloz\Recruitment\Ex1\Store;

class StoreTest extends TestCase
{
    public function testUpdate(): void
    {
        $store = new Store(1);
        $store->updateData(5);

        self::assertEquals(5, $store->toArray()['max_quantity'], 'max_quantity');
        self::assertEquals(5.0, $store->toArray()['avg_quantity'], 'avg_quantity');
        self::assertEquals(1.0, $store->toArray()['availability_rate'], 'availability_rate');
        self::assertEquals(1, $store->toArray()['available_sku_count'], 'available_sku_count');
    }
    public function testUpdateWithQuantityZero(): void
    {
        $store = new Store(1);
        $store->updateData(0);

        self::assertEquals(0, $store->toArray()['max_quantity'], 'max_quantity');
        self::assertEquals(0.0, $store->toArray()['avg_quantity'], 'avg_quantity');
        self::assertEquals(0.0, $store->toArray()['availability_rate'], 'availability_rate');
        self::assertEquals(0, $store->toArray()['available_sku_count'], 'available_sku_count');
    }
}