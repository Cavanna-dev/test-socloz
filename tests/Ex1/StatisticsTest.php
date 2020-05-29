<?php

namespace Socloz\Recruitment\Tests\Ex1;

use PHPUnit\Framework\TestCase;
use Socloz\Recruitment\Ex1\Statistics;
use Socloz\Recruitment\Ex1\Store;
use Socloz\Recruitment\Ex1\StoreCollection;

class StatisticsTest extends TestCase
{
    /**
     * @dataProvider updateData
     */
    public function testUpdateOk(
        array $stores,
        int $skuId,
        int $quantity,
        int $storeCount,
        int $skuCount,
        int $maxQuantity,
        int $avgQuantity,
        int $availabilityRate
    ): void {
        $statistics = new Statistics();
        $storeCollection = new StoreCollection();
        foreach ($stores as $store) {
            $storeCollection->add($store);
        }
        $statistics->setStoreCollection($storeCollection);
        $statistics->updateData($skuId, $quantity);

        $result = $statistics->toArray();

        self::assertEquals($storeCount, $result['store_count'], 'store_count');
        self::assertEquals($skuCount, $result['sku_count'], 'sku_count');
        self::assertEquals($maxQuantity, $result['max_quantity'], 'max_quantity');
        self::assertEquals($avgQuantity, $result['avg_quantity'], 'avg_quantity');
        self::assertEquals($availabilityRate, $result['availability_rate'], 'availability_rate');
    }

    public function updateData(): array
    {
        return [
            'ok' => [$this->generateStores(1), 1, 1, 1, 1, 1, 1, 1],
            'division_by_zero' => [$this->generateStores(1), 1, 0, 1, 1, 0, 0, 0],
            'quantity_zero_for_rate_compute' => [$this->generateStores(5), 1, 0, 5, 1, 0, 0, 0],
        ];
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