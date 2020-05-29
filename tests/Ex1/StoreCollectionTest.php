<?php

namespace Socloz\Recruitment\Tests\Ex1;

use PHPUnit\Framework\TestCase;
use Socloz\Recruitment\Ex1\Store;
use Socloz\Recruitment\Ex1\StoreCollection;

class StoreCollectionTest extends TestCase
{
    public function testCount(): void
    {
        $storeCollection = new StoreCollection();
        foreach ($this->generateStores(5) as $store) {
            $storeCollection->add($store);
        }

        self::assertEquals(5, $storeCollection->count());
    }

    public function testAdd(): void
    {
        $storeCollection = new StoreCollection();
        foreach ($this->generateStores(5) as $store) {
            $storeCollection->add($store);
        }

        $alreadyExistingStore = new Store(1);
        $storeCollection->add($alreadyExistingStore);

        self::assertEquals(5, $storeCollection->count());
    }

    public function testGet(): void
    {
        $storeCollection = new StoreCollection();
        foreach ($this->generateStores(5) as $store) {
            $storeCollection->add($store);
        }

        self::assertInstanceOf(Store::class, $storeCollection->get(1));
    }

    public function testGetInexistingStore(): void
    {
        $storeCollection = new StoreCollection();
        foreach ($this->generateStores(5) as $store) {
            $storeCollection->add($store);
        }

        self::expectException(\InvalidArgumentException::class);
        $storeCollection->get(6);
    }

    public function testExists(): void
    {
        $storeCollection = new StoreCollection();
        foreach ($this->generateStores(5) as $store) {
            $storeCollection->add($store);
        }

        self::assertTrue($storeCollection->exists(1));
        self::assertFalse($storeCollection->exists(6));
    }

    public function testToArray(): void
    {
        $storeCollection = new StoreCollection();
        foreach ($this->generateStores(2) as $store) {
            $storeCollection->add($store);
        }

        self::assertCount(2, $storeCollection->toArray());
    }

    private function generateStores(int $number): array
    {
        $stores = [];
        for ($i = 0; $i < $number; $i++) {
            $stores[] = new Store($i);
        }

        return $stores;
    }
}