<?php

namespace Marfi\ThriveCart\Tests\Products;

use Marfi\ThriveCart\Products\RedWidget;
use Marfi\ThriveCart\Data\ProductData;
use PHPUnit\Framework\TestCase;

class RedWidgetTest extends TestCase
{
    protected function setUp(): void
    {
        ProductData::setData('R01', [
            'code' => 'R01',
            'name' => 'Red Widget',
            'price' => 19.99,
            'specialOffer' => 'BuyOneGetOneHalf',
        ]);
    }

    public function testConstructor()
    {
        $redWidget = new RedWidget();

        $this->assertInstanceOf(RedWidget::class, $redWidget);
        $this->assertEquals('R01', $redWidget->getCode());
        $this->assertEquals('Red Widget', $redWidget->getName());
        $this->assertEquals(19.99, $redWidget->getPrice());
        $this->assertEquals('BuyOneGetOneHalf', $redWidget->getSpecialOffer());
    }

    public function testGetCode()
    {
        $redWidget = new RedWidget();
        $this->assertEquals('R01', $redWidget->getCode());
    }

    public function testGetName()
    {
        $redWidget = new RedWidget();
        $this->assertEquals('Red Widget', $redWidget->getName());
    }

    public function testGetPrice()
    {
        $redWidget = new RedWidget();
        $this->assertEquals(19.99, $redWidget->getPrice());
    }

    public function testGetSpecialOffer()
    {
        $redWidget = new RedWidget();
        $this->assertEquals('BuyOneGetOneHalf', $redWidget->getSpecialOffer());
    }

    public function testGetSpecialOfferWhenNone()
    {
        ProductData::setData('R01', [
            'code' => 'R01',
            'name' => 'Red Widget',
            'price' => 19.99,
            'specialOffer' => null,
        ]);

        $redWidget = new RedWidget();
        $this->assertEquals('None', $redWidget->getSpecialOffer());
    }
}
