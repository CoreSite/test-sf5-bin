<?php

declare(strict_types=1);

namespace App\Service\GoogleProtobuf;

use App\Entity\ProductImport;
use App\Service\GoogleProtobuf\Model\Product as ProtoProduct;
use Ramsey\Uuid\Uuid;

class ProtobufService
{
    /**
     * @param ProductImport $product
     *
     * @return string
     * @throws \Exception
     */
    public function packProduct(ProductImport $product): string
    {
        $protoProduct = new ProtoProduct();
        $protoProduct
            ->setId($product->getId()->toString())
            ->setTitle($product->getTitle())
            ->setDescription($product->getDescription())
            ->setPrice($product->getPrice())
            ->setEnabled($product->isEnabled());

        return $protoProduct->serializeToString();
    }

    /**
     * @param string $data
     *
     * @return ProductImport
     * @throws \Exception
     */
    public function unpackProduct(string $data): ProductImport
    {
        $protoProduct = new ProtoProduct();
        $protoProduct->mergeFromString($data);

        $product = new ProductImport();
        $product
            ->setId(Uuid::fromString($protoProduct->getId()))
            ->setTitle($protoProduct->getTitle())
            ->setDescription($protoProduct->getDescription())
            ->setPrice($protoProduct->getPrice())
            ->setEnabled($protoProduct->getEnabled());

        return $product;
    }
}
