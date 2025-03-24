<?php

use Marfi\ThriveCart\Basket;
use Marfi\ThriveCart\Data\ProductData;
use Marfi\ThriveCart\ProductFactory\ProductFactory;
use Marfi\ThriveCart\Services\BasketService;

require __DIR__ . '/vendor/autoload.php';

$configCSV = 'src/Data/products.csv'; //to do: set configuration
$cartCSV = 'basket.csv';
$productData = new ProductData('./' . $configCSV);
$productFactory = new ProductFactory($productData);
$catalog = new Basket($productFactory);
$cartService = new BasketService($catalog);
$cartService->loadProductData('./' . $cartCSV);
$cartService->setShippingRule();

echo "Basket from basket.csv Total: " . number_format($cartService->getTotal(), 2) . PHP_EOL;
