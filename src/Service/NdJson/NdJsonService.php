<?php

declare(strict_types=1);

namespace App\Service\NdJson;

use Clue\React\NDJson\Decoder;
use Clue\React\NDJson\Encoder;
use React\EventLoop\Factory;
use React\Stream\ReadableResourceStream;
use React\Stream\WritableResourceStream;

class NdJsonService
{
    /**
     * @param string $filename
     * @param array  $products
     */
    public function pack(string $filename, array $products): void
    {
        $h = fopen($filename, 'wb+');

        $loop = Factory::create();
        $out = new WritableResourceStream($h, $loop);
        $stream = new Encoder($out);

        foreach ($products as $product) {
            $stream->write(DataTransformer::packProduct($product));
        }

        $loop->run();

        $stream->end();
        $stream->close();
    }

    /**
     * @param string $filename
     *
     * @return array
     */
    public function unpack(string $filename): array
    {
        $h = fopen($filename, 'rb');

        $loop = Factory::create();
        $in = new ReadableResourceStream($h, $loop);
        $stream = new Decoder($in);

        $products = [];

        $stream->on('data', static function ($data) use (&$products) {
            $products[] = DataTransformer::unpackProduct($data);
        });

        $loop->run();

        $stream->close();

        return $products;
    }
}
