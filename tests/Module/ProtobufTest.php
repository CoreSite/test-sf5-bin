<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Service\GoogleProtobuf\ProtobufService;

class ProtobufTest extends AbstractServiceTest
{
    private ProtobufService $protobufService;

    protected function setUp()
    {
        self::bootKernel();
        $this->protobufService = self::$container->get(ProtobufService::class);
    }

    /**
     * @throws \Exception
     */
    public function testProtobuf()
    {
        $products = $this->productsData();
        $product = $products[0];

        $packedData = $this->protobufService->packProduct($product);

        $unpackedData = $this->protobufService->unpackProduct($packedData);

        $this->assertEquals($product, $unpackedData);
    }
}
