<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Entity\Product;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ServiceTest extends WebTestCase
{
    private const PRODUCTS_COUNT = 1000;

    protected function productsData(): array
    {
        $products = [];

        for ($i = 0; $i < self::PRODUCTS_COUNT; ++$i) {
            $product = new Product();
            $product
                ->setId(Uuid::uuid1())
                ->setTitle(sprintf('Product %d', $i))
                ->setDescription(sprintf('Product description #%d', $i))
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setEnabled(true)
                ->setPrice(random_int(1, 5) * 100);

            $products[] = $product;
        }

        return $products;
    }
}
