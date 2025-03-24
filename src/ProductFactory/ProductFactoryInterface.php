<?php

namespace Marfi\ThriveCart\ProductFactory;

use Marfi\ThriveCart\Product;

interface ProductFactoryInterface
{
    public function createProduct(string $productCode): Product;
}
