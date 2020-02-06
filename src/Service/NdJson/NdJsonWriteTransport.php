<?php

declare(strict_types=1);

namespace App\Service\NdJson;

use App\Entity\ProductImport;

class NdJsonWriteTransport
{
    protected $handle;

    /**
     * NdJsonWriteTransport constructor.
     * @param null $handle
     */
    public function __construct($handle = null)
    {
        $this->handle = $handle;
        ob_start();
        if (!$this->handle) {
            $this->handle = fopen('php://output', 'wb');
        }
    }

    /**
     * @param ProductImport $product
     */
    public function addProduct(ProductImport $product): void
    {
        fwrite($this->handle, DataTransformer::packProduct($product));
        ob_flush();
    }

    public function close(): void
    {
        ob_clean();
        fclose($this->handle);
    }
}
