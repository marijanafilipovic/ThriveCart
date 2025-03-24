<?php

namespace Marfi\ThriveCart\Data;

use Marfi\ThriveCart\Data\ProductData;

enum ProductEnum: string
{
    case R01 = 'R01';
    case B01 = 'B01';
    case G01 = 'G01';

    /**
     * @return array<string, mixed>|null
     */
    public function getDetails(): ?array
    {
        return ProductData::getData($this->value);
    }

    public function getName(): string
    {

        return $this->getDetails()['name'] ?? 'Unknown Product';
    }

    public function getPrice(): float
    {
        $productDetails = $this->getDetails();

        return $productDetails['price'] ?? 0.0;
    }

    public function getSpecialOffer(): string
    {
        return match ($this) {
            self::R01 => 'BuyOneGetOneHalf',
            self::B01, self::G01 => 'None',
        };
    }

    public function getProductClass(): string
    {
        return "Marfi\\ThriveCart\\Products\\" . match ($this) {
            self::R01 => 'RedWidget',
            self::B01 => 'BlueWidget',
            self::G01 => 'GreenWidget',
        };
    }
}
