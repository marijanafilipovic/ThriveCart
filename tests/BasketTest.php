<?php
use PHPUnit\Framework\TestCase;
use Marfi\ThriveCart\Basket;
use Marfi\ThriveCart\ProductFactory\ProductFactoryInterface;
use Marfi\ThriveCart\Product;

class BasketTest extends TestCase
{
    private $mockProductFactory;
    private $basket;

    protected function setUp(): void
    {
        $this->mockProductFactory = $this->createMock(ProductFactoryInterface::class);
        $this->basket = new Basket($this->mockProductFactory);
    }

    public function testAddProductByCodeValidProduct(): void
    {
        $mockProduct = $this->createMock(Product::class);
        $this->mockProductFactory->method('createProduct')
            ->willReturn($mockProduct);
        $this->basket->addProductByCode('R01');
        $this->assertCount(1, $this->basket->getProducts());
    }

    public function testAddProductByCodeThrowsExceptionIfProductNotFound(): void
    {
        $this->mockProductFactory->method('createProduct')
            ->willThrowException(new \Exception("Product details not found"));
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Product details not found for product code: X99');
        $this->basket->addProductByCode('X99');
    }
}

