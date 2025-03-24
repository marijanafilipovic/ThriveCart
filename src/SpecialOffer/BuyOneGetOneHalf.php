<?php

namespace Marfi\ThriveCart\SpecialOffer;

use Marfi\ThriveCart\SpecialOffer\SpecialOffer;

class BuyOneGetOneHalf implements SpecialOffer
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    public function apply(array &$items): float
    {
        $discount = 0.0;
        $productPrice = 0.0;

        $matchingIndices = [];

        foreach ($items as $index => $item) {
            if ($item->getCode() === $this->productCode) {
                $matchingIndices[] = $index;
                $productPrice = $item->getPrice();
            }
            if (count($matchingIndices) % 2 === 0) {
                $index1 = array_shift($matchingIndices);
                $index2 = array_shift($matchingIndices);

                unset($items[$index1], $items[$index2]);

                $discount += $productPrice / 2;
            }
        }

        return $discount;
    }
}
