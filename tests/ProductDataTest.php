<?php

namespace Marfi\ThriveCart\Tests\Data;

use Marfi\ThriveCart\Data\ProductData;
use PHPUnit\Framework\TestCase;

class ProductDataTest extends TestCase
{
    private string $testProductCsv;
    private string $testCartCsv;

    protected function setUp(): void
    {
        $this->testProductCsv = sys_get_temp_dir() . '/test_products.csv';
        file_put_contents($this->testProductCsv, "code,name,price,specialOffer\nR01,Red Widget,19.99,BuyOneGetOneHalf\nB01,Blue Widget,9.99,None\n");

        $this->testCartCsv = sys_get_temp_dir() . '/test_cart.csv';
        file_put_contents($this->testCartCsv, "code\nR01\nB01\nG01\n");
    }

    protected function tearDown(): void
    {
        @unlink($this->testProductCsv);
        @unlink($this->testCartCsv);
    }

    public function testLoadFromCsv(): void
    {
        $data = ProductData::loadFromCsv($this->testProductCsv);

        $this->assertArrayHasKey('R01', $data);
        $this->assertArrayHasKey('B01', $data);
        $this->assertSame('Red Widget', $data['R01']['name']);
        $this->assertSame(19.99, $data['R01']['price']);
        $this->assertSame('BuyOneGetOneHalf', $data['R01']['specialOffer']);
    }

    public function testGetData(): void
    {
        ProductData::loadFromCsv($this->testProductCsv);
        $product = ProductData::getData('R01');

        $this->assertIsArray($product);
        $this->assertSame('Red Widget', $product['name']);
        $this->assertSame(19.99, $product['price']);
    }

    public function testLoadProductsFromCart(): void
    {
        $productCodes = ProductData::loadProductsFromCart($this->testCartCsv);

        $this->assertCount(3, $productCodes);
        $this->assertSame(['R01', 'B01', 'G01'], $productCodes);
    }

    public function testLoadFromCsvThrowsExceptionOnMissingFile(): void
    {
        $this->expectException(\RuntimeException::class);
        ProductData::loadFromCsv('/invalid/path/products.csv');
    }

    public function testLoadProductsFromCartThrowsExceptionOnMissingFile(): void
    {
        $this->expectException(\RuntimeException::class);
        ProductData::loadProductsFromCart('/invalid/path/cart.csv');
    }
}
