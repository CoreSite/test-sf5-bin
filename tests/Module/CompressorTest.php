<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Service\Compressor\CompressorReader;
use App\Service\Compressor\CompressorWriter;

class CompressorTest extends AbstractServiceTest
{
    private string $varDir;

    protected function setUp()
    {
        $this->varDir = self::bootKernel()->getProjectDir().'/var';
    }

    public function testCompressor(): void
    {
        $products = $this->productsData(1000);

        $compressorWriter = new CompressorWriter($this->varDir.'/test.data');

        foreach ($products as $product) {
            $compressorWriter->add($product);
        }
        $compressorWriter->close();


        $compressorReader = new CompressorReader($this->varDir.'/test.data');

        $unpackProducts = [];
        foreach ($compressorReader->read() as $product) {
            $unpackProducts[] = $product;
        }

        $this->assertEquals($products, $unpackProducts);

        $compressorReader->close();
    }
}
