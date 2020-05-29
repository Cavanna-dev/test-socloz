<?php

namespace Socloz\Recruitment\Ex1;

class Store
{
    private int $id;
    private int $maxQuantity;
    private int $totalQuantity;
    private int $countQuantity;
    private int $availableQuantity;
    private int $availableSkuCount;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->maxQuantity = 0;
        $this->totalQuantity = 0;
        $this->countQuantity = 0;
        $this->availableQuantity = 0;
        $this->availableSkuCount = 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    private function setMaxQuantity(int $maxQuantity): self
    {
        if ($this->maxQuantity < $maxQuantity) {
            $this->maxQuantity = $maxQuantity;
        }

        return $this;
    }

    private function increaseTotalQuantity(int $quantity): self
    {
        $this->totalQuantity += $quantity;

        return $this;
    }

    private function incrementCountQuantity(): self
    {
        $this->countQuantity++;

        return $this;
    }

    private function incrementAvailableQuantity(): self
    {
        $this->availableQuantity++;

        return $this;
    }

    private function incrementAvailableSkuCount(): self
    {
        $this->availableSkuCount++;

        return $this;
    }

    private function getAverageQuantity(): float
    {
        if ($this->countQuantity === 0) {
            return 0;
        }

        return round($this->totalQuantity / $this->countQuantity, 13);
    }

    private function getAvailabilityRate(): float
    {
        if ($this->countQuantity === 0) {
            return 0;
        }

        return round($this->availableQuantity / $this->countQuantity, 14);
    }

    public function updateData(int $quantity): void
    {
        $this
            ->setMaxQuantity($quantity)
            ->increaseTotalQuantity($quantity)
            ->incrementCountQuantity()
        ;
        if ($quantity > 0) {
            $this
                ->incrementAvailableQuantity()
                ->incrementAvailableSkuCount()
            ;
        }
    }

    public function toArray(): array
    {
        return [
            'max_quantity' => $this->maxQuantity,
            'avg_quantity' => $this->getAverageQuantity(),
            'availability_rate' => $this->getAvailabilityRate(),
            'available_sku_count' => $this->availableSkuCount,
        ];
    }
}