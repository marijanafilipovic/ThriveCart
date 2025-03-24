<?php

namespace Marfi\ThriveCart\ProductFactory;

use Marfi\ThriveCart\Data\ProductData;
use Marfi\ThriveCart\Data\ProductEnum;
use Marfi\ThriveCart\Product;

class ProductFactory implements ProductFactoryInterface
{
    private ProductData $productData;

    public function __construct(ProductData $productData)
    {
        $this->productData = $productData;
    }

    public function createProduct(string $productCode): Product
    {
        $productEnum = ProductEnum::tryFrom($productCode);
        if ($productEnum) {
            $productClass = $productEnum->getProductClass();
            if (class_exists($productClass)) {
                $productInstance = new $productClass($this->productData);
                if (!$productInstance instanceof Product) {
                    throw new \Exception("Product is not an instance of Product class.");
                }
                
                return $productInstance;
            }
            throw new \Exception("Product is not an instance of Product class.");
        }
        throw new \Exception("Product details not found for product code: $productCode");
    }
}
