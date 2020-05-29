<?php

namespace Socloz\Recruitment\Ex1;

class Statistics
{
    private array $skuIds;
    private int $quantityCount;
    private int $quantityTotal;
    private int $quantityAvailable;
    private int $maxQuantity;
    private StoreCollection $storeCollection;

    public function __construct()
    {
        $this->maxQuantity = 0;
        $this->quantityAvailable = 0;
        $this->quantityCount = 0;
        $this->quantityTotal = 0;
    }

    private function addSku(int $skuId): self
    {
        if (!isset($this->skuIds[$skuId])) {
            $this->skuIds[$skuId] = $skuId;
        }

        return $this;
    }

    private function setMaxQuantity(int $quantity): self
    {
        $this->maxQuantity = max($quantity, $this->maxQuantity);

        return $this;
    }

    private function incrementQuantityCount(): self
    {
        $this->quantityCount++;

        return $this;
    }

    private function increaseQuantityTotal(int $quantity): self
    {
        $this->quantityTotal += $quantity;

        return $this;
    }

    private function incrementQuantityAvailable(): self
    {
        $this->quantityAvailable++;

        return $this;
    }

    private function getAvgQuantity(): float
    {
        if ($this->quantityCount === 0) {
            return 0;
        }

        return round($this->quantityTotal / $this->quantityCount, 13);
    }

    private function getAvailabilityRate(): float
    {
        if ($this->quantityCount === 0) {
            return 0;
        }

        return round($this->quantityAvailable / $this->quantityCount, 14);
    }

    public function setStoreCollection(StoreCollection $storeCollection): self
    {
        $this->storeCollection = $storeCollection;

        return $this;
    }

    public function updateData(int $skuId, int $quantity): void
    {
        $this
            ->addSku($skuId)
            ->setMaxQuantity($quantity)
            ->incrementQuantityCount()
            ->increaseQuantityTotal($quantity)
        ;
        if ($quantity > 0) {
            $this->incrementQuantityAvailable();
        }
    }

    public function toArray(): array
    {
        return [
            'store_count' => $this->storeCollection->count(),
            'sku_count' => count($this->skuIds),
            'max_quantity' => $this->maxQuantity,
            'avg_quantity' => $this->getAvgQuantity(),
            'availability_rate' => $this->getAvailabilityRate(),
            'stores' => $this->storeCollection->toArray(),
        ];
    }
}