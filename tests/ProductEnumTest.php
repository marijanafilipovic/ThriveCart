<?php

namespace Marfi\ThriveCart\Tests\Data;

use Marfi\ThriveCart\Data\ProductEnum;
use Marfi\ThriveCart\Data\ProductData;
use PHPUnit\Framework\TestCase;

class ProductEnumTest extends TestCase
{
    protected function setUp(): void
    {
        ProductData::setData('R01', [
            'code' => 'R01',
            'name' => 'Red Widget',
            'price' => 19.99,
            'specialOffer' => 'BuyOneGetOneHalf',
        ]);

        ProductData::setData('B01', [
            'code' => 'B01',
            'name' => 'Blue Widget',
            'price' => 9.99,
            'specialOffer' => 'None',
        ]);

        ProductData::setData('G01', [
            'code' => 'G01',
            'name' => 'Green Widget',
            'price' => 12.49,
            'specialOffer' => 'None',
        ]);
    }

    public function testGetDetails()
    {
        $this->assertEquals([
            'code' => 'R01',
            'name' => 'Red Widget',
            'price' => 19.99,
            'specialOffer' => 'BuyOneGetOneHalf',
        ], ProductEnum::R01->getDetails());

        $this->assertEquals([
            'code' => 'B01',
            'name' => 'Blue Widget',
            'price' => 9.99,
            'specialOffer' => 'None',
        ], ProductEnum::B01->getDetails());

        $this->assertEquals([
            'code' => 'G01',
            'name' => 'Green Widget',
            'price' => 12.49,
            'specialOffer' => 'None',
        ], ProductEnum::G01->getDetails());
    }

    public function testGetName()
    {
        $this->assertEquals('Red Widget', ProductEnum::R01->getName());
        $this->assertEquals('Blue Widget', ProductEnum::B01->getName());
        $this->assertEquals('Green Widget', ProductEnum::G01->getName());

        $this->assertEquals('Unknown Product', ProductEnum::tryFrom('X01')?->getName() ?? 'Unknown Product');
    }

    public function testGetPrice()
    {
        $this->assertEquals(19.99, ProductEnum::R01->getPrice());
        $this->assertEquals(9.99, ProductEnum::B01->getPrice());
        $this->assertEquals(12.49, ProductEnum::G01->getPrice());

        $this->assertEquals(0.0, ProductEnum::tryFrom('X01')?->getPrice() ?? 0.0);
    }

    public function testGetSpecialOffer()
    {
        $this->assertEquals('BuyOneGetOneHalf', ProductEnum::R01->getSpecialOffer());
        $this->assertEquals('None', ProductEnum::B01->getSpecialOffer());
        $this->assertEquals('None', ProductEnum::G01->getSpecialOffer());
    }

    public function testGetProductClass()
    {
        $this->assertEquals('Marfi\\ThriveCart\\Products\\RedWidget', ProductEnum::R01->getProductClass());
        $this->assertEquals('Marfi\\ThriveCart\\Products\\BlueWidget', ProductEnum::B01->getProductClass());
        $this->assertEquals('Marfi\\ThriveCart\\Products\\GreenWidget', ProductEnum::G01->getProductClass());
    }
}
