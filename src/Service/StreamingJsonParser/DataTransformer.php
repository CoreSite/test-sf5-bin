<?php

declare(strict_types=1);

namespace App\Service\StreamingJsonParser;

use App\Entity\Product;
use Ramsey\Uuid\Uuid;

class DataTransformer
{
    /**
     * @param Product $product
     *
     * @return array
     */
    public static function packProduct(Product $product): array
    {
        return [
            $product->getId(),
            $product->getTitle(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getCreatedAt()->format('c'),
            $product->getUpdatedAt()->format('c'),
            $product->isEnabled(),
        ];
    }

    /**
     * @param array $data
     *
     * @return Product
     * @throws \Exception
     */
    public static function unpackProduct(array $data): Product
    {
        $product = new Product();
        $product
            ->setId(Uuid::fromString($data[0]))
            ->setTitle($data[1])
            ->setDescription($data[2])
            ->setPrice($data[3])
            ->setCreatedAt(new \DateTime($data[4]))
            ->setUpdatedAt(new \DateTime($data[5]))
            ->setEnabled($data[6]);

        return $product;
    }
}
