<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ProductImport;
use Ramsey\Uuid\Uuid;

class ProductService
{
    private const PRODUCTS_COUNT = 1000;
    private const PROPERTIES_COUNT = 5;

    /**
     * @param int $count
     *
     * @return array
     * @throws \Exception
     */
    public function genProducts(int $count = self::PRODUCTS_COUNT): array
    {
        $products = [];

        for ($i = 0; $i < $count; ++$i) {
            $products[] = $this->getProduct($i);
        }

        return $products;
    }

    /**
     * @param int $i
     *
     * @return ProductImport
     * @throws \Exception
     */
    public function getProduct(int $i = 0): ProductImport
    {
        $product = new ProductImport();
        $product->id = Uuid::uuid1();
        $product->title = sprintf('Product %d', $i);
        $product->description = sprintf("Product\ndescription #%d", $i);
        $product->createdAt = new \DateTime();
        $product->updatedAt = new \DateTime();
        $product->enabled = true;
        $product->price = random_int(1, 5) * 100;

        for ($j = 0; $j <= self::PROPERTIES_COUNT; ++$j) {
            $product->properties += ['property_name_'.$j => 'Property value_'.$j];
        }

        return $product;
    }
}
