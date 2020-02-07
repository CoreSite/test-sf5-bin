<?php

declare(strict_types=1);

namespace App\Service\NdJson;

use App\Entity\ProductImport;

class NdJsonReadTransport
{
    protected $handle;

    /**
     * @param resource $handle
     */
    public function __construct($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return \Generator|ProductImport[]|null
     * @throws \Exception
     */
    public function readProducts(): ?\Generator
    {
        while (false !== ($buffer = fgets($this->handle))) {
            yield DataTransformer::unpackProduct($buffer);
        }
    }

    /**
     * @return \Generator|null
     */
    public function readProductsAsString(): ?\Generator
    {
        while (false !== ($buffer = fgets($this->handle))) {
            yield $buffer;
        }
    }

    public function close(): void
    {
        fclose($this->handle);
    }
}
