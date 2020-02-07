<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Entity\ProductImport;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractServiceTest extends WebTestCase
{
    private const PRODUCTS_COUNT = 5;

    protected function productsData(int $count = self::PRODUCTS_COUNT): array
    {
        $products = [];

        for ($i = 0; $i < $count; ++$i) {
            $product = new ProductImport();
            $product
                ->setId(Uuid::uuid1())
                ->setTitle(sprintf('Product %d', $i))
                ->setDescription(sprintf("Product\ndescription #%d", $i))
                ->setCreatedAt(new \DateTime('2020-01-31 00:00:00'))
                ->setUpdatedAt(new \DateTime('2020-01-31 00:00:00'))
                ->setEnabled(true)
                ->setPrice(random_int(1, 5) * 100);

            for ($j = 0; $j <= 3; ++$j) {
                $product->properties += ['property_name_'.$j => 'Property value_'.$j];
            }

            $products[] = $product;
        }

        return $products;
    }
}
