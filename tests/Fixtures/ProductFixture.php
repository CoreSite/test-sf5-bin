<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\ProductImport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class ProductFixture extends Fixture
{
    private const PRODUCTS_COUNT = 10;

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $products = [];

        for ($i = 0; $i < self::PRODUCTS_COUNT; ++$i) {
            $product = new ProductImport();
            $product
                ->setId(Uuid::uuid1())
                ->setTitle(sprintf('Product %d', $i))
                ->setDescription(sprintf('Product description #%d', $i))
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setEnabled(true)
                ->setPrice(random_int(1, 5) * 100);
        }

        $this->addReference('products', $products);
    }
}
