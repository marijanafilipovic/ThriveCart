<?php

namespace Marfi\ThriveCart;

use Marfi\ThriveCart\Data\ProductEnum;
use Marfi\ThriveCart\ProductFactory\ProductFactoryInterface;
use Marfi\ThriveCart\Shipping\ShippingRule;
use Marfi\ThriveCart\SpecialOffer\SpecialOffer;

class Basket
{
    /** @var Product[] */
    private array $products = [];
    private ProductFactoryInterface $productFactoryInterface;
    private ?ShippingRule $shippingRule = null;

    public function __construct(ProductFactoryInterface $productFactoryInterface)
    {
        $this->productFactoryInterface = $productFactoryInterface;
    }

    public function addProductByCode(string $productCode): void
    {
        try {
            $product = $this->productFactoryInterface->createProduct($productCode);
            $this->products[] = $product;
        } catch (\Exception $e) {
            throw new \Exception("Product details not found for product code: $productCode");
        }
    }

    public function setShippingRule(ShippingRule $shippingRule): void
    {
        $this->shippingRule = $shippingRule;
    }

    public function getTotal(): float
    {
        $total = array_reduce($this->products, fn($sum, $product) => $sum + $product->getPrice(), 0);
        $totalDiscount = 0.0;
        foreach ($this->products as $product) {
            $productEnum = ProductEnum::tryFrom($product->getCode());
            if ($productEnum && ($specialOffer = $productEnum->getSpecialOffer())) {
                $discountClass = "Marfi\\ThriveCart\\SpecialOffer\\" . $specialOffer;
                if (class_exists($discountClass) && is_subclass_of($discountClass, SpecialOffer::class)) {
                    $discount = new $discountClass($product->getCode());
                    $totalDiscount += $discount->apply($this->products);
                }
            }
        }
        $totalAfterDiscounts =  $total - $totalDiscount;
        $shippingCost = $this->shippingRule ? $this->shippingRule->calculate($totalAfterDiscounts) : 0.0;
        $totalForPay = round($totalAfterDiscounts + $shippingCost, 2, PHP_ROUND_HALF_DOWN);

        return $totalForPay;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
