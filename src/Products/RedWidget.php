<?php

namespace Marfi\ThriveCart\Products;

use Marfi\ThriveCart\Data\ProductEnum;
use Marfi\ThriveCart\Product;

class RedWidget extends Product
{
    protected string $code;
    protected string $name;
    protected float $price;
    protected ?string $specialOffer;

    public function __construct()
    {
        $productEnum = ProductEnum::R01;
        $productDetails = $productEnum->getDetails();

        if ($productDetails === null) {
            throw new \Exception("Product details not found for {$productEnum->value}");
        }

        $this->code = $productEnum->value;
        $this->name = $productDetails['name'];
        $this->price = $productDetails['price'];
        $this->specialOffer = $productDetails['specialOffer'] ?? null;

        parent::__construct($this->code, $this->name, $this->price, $this->specialOffer);
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

    public function getSpecialOffer(): ?string
    {
        return $this->specialOffer ?? 'None';
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
