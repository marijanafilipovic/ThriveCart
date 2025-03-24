<?php

namespace Marfi\ThriveCart\Data;

class ProductData
{
    /** @var array<string, mixed>[] */
    private static array $data = [];

    public function __construct(string $filename)
    {
        $this->loadFromCsv($filename);
    }
    /**
     * Load product data from a CSV file.
     * 
     * @param string $filename
     * @return array<string, mixed>[]
     */
    public static function loadFromCsv(string $filename): array
    {
        self::$data = [];

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new \RuntimeException("CSV file not found or not readable: $filename");
        }

        if (($handle = fopen($filename, "r")) !== false) {
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($data) < 4) {
                    continue;
                }

                [$code, $name, $price, $specialOffer] = $data;

                self::setData($code, [
                    'code' => trim($code ?? ''),
                    'name' => trim($name ?? ''),
                    'price' => is_numeric($price) ? (float) $price : 0.0,
                    'specialOffer' => trim($specialOffer ?? '') !== "" ? trim($specialOffer ?? '') : null,
                ]);
            }
            fclose($handle);
        }

        return self::$data;
    }

    /**
     * Load product codes from a cart CSV file.
     * 
     * @param string $filePath
     * @param bool $hasHeader Whether the first row is a header.
     * @return string[]
     */
    public static function loadProductsFromCart(string $filePath, bool $hasHeader = true): array
    {
        $productCodes = [];

        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new \RuntimeException("Cart CSV file not found or not readable: $filePath");
        }

        if (($handle = fopen($filePath, 'r')) !== false) {
            if ($hasHeader) {
                fgetcsv($handle);
            }

            while (($row = fgetcsv($handle)) !== false) {
                if (!empty($row[0])) {
                    $productCodes[] = trim($row[0]);
                }
            }

            fclose($handle);
        }

        return $productCodes;
    }

    /**
     * Set product data.
     *
     * @param string|null $code Product code.
     * @param array<string, mixed> $details Product details array.
     */
    public static function setData(?string $code, array $details): void
    {
        if ($code !== null) {
            self::$data[$code] = $details;
        }
    }

    /**
     * Get product data.
     * 
     * @param string $code Product code.
     * @return array<string, mixed>|null
     */
    public static function getData(string $code): ?array
    {
        return self::$data[$code] ?? null;
    }
}
