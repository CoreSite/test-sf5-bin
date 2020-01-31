<?php

declare(strict_types=1);

namespace App\Service\GoogleProtobuf;

use App\Entity\Product;
use App\Service\GoogleProtobuf\Model\Product as ProtoProduct;
use Ramsey\Uuid\Uuid;

class ProtobufService
{
    /**
     * @param Product $product
     *
     * @return string
     * @throws \Exception
     */
    public function packProduct(Product $product): string
    {
        $protoProduct = new ProtoProduct();
        $protoProduct
            ->setId($product->getId()->toString())
            ->setTitle($product->getTitle())
            ->setDescription($product->getDescription())
            ->setPrice($product->getPrice());

        return $protoProduct->serializeToString();
    }

    /**
     * @param string $data
     *
     * @return Product
     * @throws \Exception
     */
    public function unpackProduct(string $data): Product
    {
        $protoProduct = new ProtoProduct();
        $protoProduct->mergeFromString($data);

        $product = new Product();
        $product
            ->setId(Uuid::fromString($protoProduct->getId()))
            ->setTitle($protoProduct->getTitle())
            ->setDescription($protoProduct->getDescription())
            ->setPrice($protoProduct->getPrice());

        return $product;
    }
}
