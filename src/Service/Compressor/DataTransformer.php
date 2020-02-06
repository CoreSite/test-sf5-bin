<?php

declare(strict_types=1);

namespace App\Service\Compressor;

use App\Entity\ProductImport;
use Ramsey\Uuid\Uuid;

class DataTransformer
{
    /**
     * @param ProductImport $product
     *
     * @return string
     */
    public static function packProduct(ProductImport $product): string
    {
        $data = [
            $product->getId(),
            $product->getTitle(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getCreatedAt()->format('c'),
            $product->getUpdatedAt()->format('c'),
            $product->isEnabled(),
        ];

        return base64_encode(json_encode($data))."\n";
    }

    /**
     * @throws \Exception
     */
    public static function unpackProduct(string $data): ProductImport
    {
        $data = json_decode(base64_decode($data), false);
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
