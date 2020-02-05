<?php

declare(strict_types=1);

namespace App\Service\NdJson;

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
            $product->id,
            $product->title,
            $product->description,
            $product->price,
            $product->properties,
            $product->createdAt->format('c'),
            $product->updatedAt->format('c'),
            $product->enabled,
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
        $product->id = Uuid::fromString($data[0]);
        $product->title = $data[1];
        $product->description = $data[2];
        $product->price = $data[3];
        $product->properties = $data[4];
        $product->createdAt = new \DateTime($data[5]);
        $product->updatedAt = new \DateTime($data[6]);
        $product->enabled = $data[7];

        return $product;
    }
}
