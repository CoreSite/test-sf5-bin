<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Service\MessagePack\MessagePackService;

class MessagePackServiceTest extends ServiceTest
{
    private MessagePackService $messagePackService;

    protected function setUp()
    {
        self::bootKernel();
        $this->messagePackService = self::$container->get(MessagePackService::class);
    }

    public function testMessagePack(): void
    {
        $products = $this->productsData();

        $packedData = $this->messagePackService->pack($products);

        $unpackedData = $this->messagePackService->unpack($packedData);

        $this->assertEquals($products, $unpackedData);
    }
}
