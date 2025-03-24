<?php

namespace Marfi\ThriveCart\Services;

use Marfi\ThriveCart\Basket;
use Marfi\ThriveCart\Shipping\StandardShipping;
use Marfi\ThriveCart\Data\ProductData;

class BasketService
{
    private Basket $cart;

    public function __construct(Basket $cart)
    {
        $this->cart = $cart;
    }

    public function loadProductData(string $cartDataPath): void
    {
        $basketProducts = ProductData::loadProductsFromCart($cartDataPath);
        if ($basketProducts) {
            foreach ($basketProducts as $productCode) {
                $this->cart->addProductByCode($productCode);
            }
        }
    }

    public function setShippingRule(): void
    {
        $this->cart->setShippingRule(new StandardShipping());
    }

    public function getTotal(): float
    {
        return $this->cart->getTotal();
    }
}
