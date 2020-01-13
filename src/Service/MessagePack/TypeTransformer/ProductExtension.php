<?php

declare(strict_types=1);

namespace App\Service\MessagePack\TypeTransformer;

use App\Entity\Product;
use MessagePack\BufferUnpacker;
use MessagePack\Packer;
use MessagePack\TypeTransformer\Extension;

class ProductExtension implements Extension
{
    private const TYPE = 10;

    /**
     * @param Packer  $packer
     * @param Product $value
     *
     * @return string|null
     */
    public function pack(Packer $packer, $value): ?string
    {
        if (!$value instanceof Product) {
            return null;
        }

        return $packer->packExt(self::TYPE, $packer->packStr(serialize($value)));
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return self::TYPE;
    }

    /**
     * @param BufferUnpacker $unpacker
     * @param int            $extLength
     *
     * @return mixed
     */
    public function unpackExt(BufferUnpacker $unpacker, int $extLength)
    {
        return unserialize($unpacker->unpackStr());
    }
}
