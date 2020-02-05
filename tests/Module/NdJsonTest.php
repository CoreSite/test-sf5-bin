<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Service\NdJson\NdJsonService;

class NdJsonTest extends AbstractServiceTest
{
    private NdJsonService $ndJsonService;

    private string $varDir;

    protected function setUp()
    {
        self::bootKernel();
        $this->ndJsonService = self::$container->get(NdJsonService::class);
        $this->varDir = self::bootKernel()->getProjectDir().'/var';
    }

    public function testNdJson(): void
    {
        $products = $this->productsData(1000);

        $this->ndJsonService->pack($this->varDir.'/test.ndjson', $products);

        $unpackProducts = $this->ndJsonService->unpack($this->varDir.'/test.ndjson');

        $this->assertEquals($products, $unpackProducts);
    }
}
