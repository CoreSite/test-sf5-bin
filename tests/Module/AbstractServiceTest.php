<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Entity\Product;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractServiceTest extends WebTestCase
{
    private const PRODUCTS_COUNT = 1000;

    protected function productsData(int $count = self::PRODUCTS_COUNT): array
    {
        $products = [];

        for ($i = 0; $i < $count; ++$i) {
            $product = new Product();
            $product
                ->setId(Uuid::uuid1())
                ->setTitle(sprintf('Product %d', $i))
                ->setDescription(sprintf("Product\ndescription #%d", $i))
                ->setCreatedAt(new \DateTime('2020-01-31 00:00:00'))
                ->setUpdatedAt(new \DateTime('2020-01-31 00:00:00'))
                ->setEnabled(true)
                ->setPrice(random_int(1, 5) * 100);

            $products[] = $product;
        }

        return $products;
    }
}
