<?php

declare(strict_types=1);

namespace App\Service\Compressor;

use App\Entity\Product;
use Ramsey\Uuid\Uuid;

class DataTransformer
{
    /**
     * @param Product $product
     *
     * @return string
     */
    public static function packProduct(Product $product): string
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
    public static function unpackProduct(string $data): Product
    {
        $data = json_decode(base64_decode($data), false);
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
