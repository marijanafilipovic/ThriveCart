<?php

namespace Marfi\ThriveCart\Products;

use Marfi\ThriveCart\Data\ProductEnum;
use Marfi\ThriveCart\Product;

class GreenWidget extends Product
{
    private ProductEnum $productEnum;
    protected string $code;
    protected string $name;
    protected float $price;
    protected ?string $specialOffer;

    public function __construct()
    {
        $this->productEnum = ProductEnum::G01;
        $productDetails = $this->productEnum->getDetails();
        if ($productDetails === null) {
            throw new \Exception("Product details not found for {$this->productEnum->value}");
        }
        $this->code = $this->productEnum->value;
        $this->name = $productDetails['name'];
        $this->price = $productDetails['price'];
        $this->specialOffer = $productDetails['specialOffer'];
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSpecialOffer(): string
    {
        return $this->specialOffer ?? 'None';
    }
}
