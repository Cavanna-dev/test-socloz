<?php

namespace Socloz\Recruitment\Ex1;

/**
 * @package Socloz\Recruitment\Ex1
 */
class FileAnalyzer
{
    public static function generateStats(string $dataFileName): array
    {
        $handle = fopen($dataFileName, "r");
        if (!$handle) {
            throw new \InvalidArgumentException('file invalid');
        }

        $statistics = new Statistics();
        $stores = new StoreCollection();

        while (!feof($handle)) {
            $line = fgets($handle);
            if ($line === false) {
                continue;
            }

            $lineData = explode(',', trim($line));

            $storeId = $lineData[0];
            $skuId = $lineData[1];
            $quantity = $lineData[2];

            $stores->add(new Store($storeId));
            $statistics->updateData($skuId, $quantity);
            $stores->get($storeId)->updateData($quantity);
        }
        fclose($handle);

        $statistics->setStoreCollection($stores);

        return $statistics->toArray();
    }
}
