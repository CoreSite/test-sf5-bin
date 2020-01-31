<?php

declare(strict_types=1);

namespace App\Service\Compressor;

use App\Entity\Product;

class CompressorWriter extends Compressor
{
    /**
     * Compressor constructor.
     *
     * @throws \Exception
     */
    public function __construct(?string $filename = null)
    {
        $this->filename = $filename;
        if (!$this->filename) {
            $this->filename = md5(time().random_int(1, 999));
        }

        $this->handle = fopen($this->filename, 'wb+');
    }

    /**
     * @param Product $product
     */
    public function add(Product $product): void
    {
        $data = DataTransformer::packProduct($product);

        fwrite($this->handle, $data);
    }
}
