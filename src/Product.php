<?php

namespace Marfi\ThriveCart;

abstract class Product
{
    protected string $code;
    protected string $name;
    protected float $price;
    protected ?string $specialOffer;

    public function __construct(string $code, string $name, float $price, ?string $specialOffer)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->specialOffer = $specialOffer;
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

    public function getSpecialOffer(): string|null
    {
        return $this->specialOffer;
    }
}
