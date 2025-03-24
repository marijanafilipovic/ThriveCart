<?php

namespace  Marfi\ThriveCart\SpecialOffer;

use Marfi\ThriveCart\Product;

interface SpecialOffer
{
    /**
     * Apply special offer to items in the cart.
     * 
     * @param array<Product> $items List of products to apply the offer to.
     * 
     * @return float The discount amount.
     */
    public function apply(array &$items): float;
}
