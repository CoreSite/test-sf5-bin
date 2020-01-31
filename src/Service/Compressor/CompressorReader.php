<?php

declare(strict_types=1);

namespace App\Service\Compressor;

class CompressorReader extends Compressor
{
    /**
     * CompressorReader constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->handle = fopen($this->filename, 'rb+');
    }

    /**
     * @return \Generator|null
     * @throws \Exception
     */
    public function read(): ?\Generator
    {
        while (false !== ($buffer = fgets($this->handle))) {
            yield DataTransformer::unpackProduct($buffer);
        }
    }
}
