<?php

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use Marfi\ThriveCart\Services\BasketService;
use Marfi\ThriveCart\Basket;
use Marfi\ThriveCart\Data\ProductData;
use Marfi\ThriveCart\Shipping\StandardShipping;

class BasketServiceTest extends TestCase
{
    private Basket $mockBasket;
    private ProductData $mockProductData;
    private BasketService $basketService;

    protected function setUp(): void
    {
        $this->mockBasket = $this->getMockBuilder(Basket::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addProductByCode', 'setShippingRule', 'getTotal']) // Corrected method name
            ->getMock();

        $this->mockProductData = $this->createMock(ProductData::class);

        $this->basketService = new BasketService($this->mockBasket, $this->mockProductData);
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(BasketService::class, $this->basketService);
    }

    public function testSetShippingRule(): void
    {
        $this->mockBasket->expects($this->once())
            ->method('setShippingRule')
            ->with($this->isInstanceOf(StandardShipping::class));

        $this->basketService->setShippingRule();
    }

    public function testGetTotal(): void
    {
        $this->mockBasket->expects($this->once())
            ->method('getTotal')
            ->willReturn(100.0);

        $total = $this->basketService->getTotal();
        $this->assertEquals(100.0, $total);
    }
}
