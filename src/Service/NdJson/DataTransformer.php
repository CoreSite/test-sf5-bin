<?php

declare(strict_types=1);

namespace App\Service\NdJson;

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
        return json_encode([
            $product->id,
            $product->title,
            $product->description,
            $product->price,
            $product->properties,
            $product->createdAt->format('c'),
            $product->updatedAt->format('c'),
            $product->enabled,
        ])."\n";
    }

    /**
     * @param string $data
     *
     * @return ProductImport
     * @throws \Exception
     */
    public static function unpackProduct(string $data): ProductImport
    {
        $data = json_decode($data, true);

        $product = new ProductImport();
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
