<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
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
    protected function genProducts(int $count = self::PRODUCTS_COUNT): array
    {
        $products = [];

        for ($i = 0; $i < $count; ++$i) {
            $product = new Product();
            $product->id = Uuid::uuid1();
            $product->title = sprintf('Product %d', $i);
            $product->description = sprintf("Product\ndescription #%d", $i);
            $product->createdAt = new \DateTime();
            $product->updatedAt = new \DateTime();
            $product->enabled = true;
            $product->price = random_int(1, 5) * 100;

            for ($j = 0; $j <= self::PROPERTIES_COUNT; ++$j) {
                $product->properties[] += ['name_'.$j => 'value_'.$j];
            }

            $products[] = $product;
        }

        return $products;
    }
}
