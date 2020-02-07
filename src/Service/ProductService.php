<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ProductImport;
use App\Service\NdJson\NdJsonWriteTransport;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\KernelInterface;

class ProductService
{
    private const PRODUCTS_COUNT = 1000;
    private const PROPERTIES_COUNT = 5;

    private KernelInterface $kernel;

    /**
     * GenProductsCommand constructor.
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

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

    /**
     * @param int $count
     *
     * @throws \Exception
     */
    public function genProductsFile(int $count): void
    {
        $file = fopen($this->kernel->getProjectDir().'/var/products_'.$count.'.ndjson', 'wb+');

        $ndJsonWriteTransport = new NdJsonWriteTransport($file);

        for ($i = 0; $i < $count; ++$i) {
            $ndJsonWriteTransport->addProduct($this->getProduct($i));
        }

        $ndJsonWriteTransport->close();
    }
}
