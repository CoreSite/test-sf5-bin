<?php

declare(strict_types=1);

namespace App\Service\StreamingJsonParser;

use App\Entity\ProductImport;
use Ramsey\Uuid\Uuid;

class DataTransformer
{
    /**
     * @param ProductImport $product
     *
     * @return array
     */
    public static function packProduct(ProductImport $product): array
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
     * @return ProductImport
     * @throws \Exception
     */
    public static function unpackProduct(array $data): ProductImport
    {
        $product = new ProductImport();
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
