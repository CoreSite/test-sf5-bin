<?php

declare(strict_types=1);

namespace App\Service\Compressor;

abstract class Compressor
{
    protected string $filename;

    protected $handle;

    /**
     * @return string
     */
    public function close(): string
    {
        fclose($this->handle);

        return $this->filename;
    }
}
