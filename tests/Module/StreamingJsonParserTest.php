<?php

declare(strict_types=1);

namespace App\Tests\Module;

use App\Service\StreamingJsonParser\DataTransformer;
use App\Service\StreamingJsonParser\StreamingJsonParserService;

class StreamingJsonParserTest extends AbstractServiceTest
{
    private string $varDir;

    private StreamingJsonParserService $streamingJsonParserService;

    protected function setUp()
    {
        $this->varDir = self::bootKernel()->getProjectDir().'/var';
        $this->streamingJsonParserService = self::$container->get(StreamingJsonParserService::class);
    }

    public function testStreamingJsonParser(): void
    {
        $products = $this->productsData(1000);

//        $json = [];
//        foreach ($products as $product) {
//            $json[] = DataTransformer::packProduct($product);
//        }
//        file_put_contents($this->varDir . '/products_1000.json', json_encode($json));

        $this->streamingJsonParserService->read(__DIR__ . '/Fixture/products_1000.json');

    }
}
