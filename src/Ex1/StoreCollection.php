<?php

namespace Socloz\Recruitment\Ex1;

class StoreCollection implements \Countable
{
    /** @var Store[] */
    private $stores;

    public function count(): int
    {
        return count($this->stores);
    }

    public function add(Store $store): void
    {
        if (!$this->exists($store->getId())) {
            $this->stores[$store->getId()] = $store;
        }
    }

    public function get(int $storeId): Store
    {
        if (isset($this->stores[$storeId])) {
            return $this->stores[$storeId];
        }

        throw new \InvalidArgumentException('id unknown');
    }

    public function exists(int $storeId): bool
    {
        if (isset($this->stores[$storeId])) {
            return true;
        }

        return false;
    }

    public function toArray(): array
    {
        $builtArray = [];
        foreach ($this->stores as $store) {
            $builtArray[$store->getId()] = $store->toArray();
        }

        return $builtArray;
    }
}