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
    public function readProduct(): ?\Generator
    {
        while (false !== ($buffer = fgets($this->handle))) {
            yield DataTransformer::unpackProduct($buffer);
        }
    }

    public function close(): void
    {
        fclose($this->handle);
    }
}
