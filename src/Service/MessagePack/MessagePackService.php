<?php

declare(strict_types=1);

namespace App\Service\MessagePack;

use App\Service\MessagePack\TypeTransformer\ProductExtension;
use MessagePack\BufferUnpacker;
use MessagePack\Packer;

class MessagePackService
{
    /**
     * @var Packer
     */
    private Packer $packer;

    /**
     * @var BufferUnpacker
     */
    private BufferUnpacker $unpacker;

    /**
     * MessagePackService constructor.
     */
    public function __construct()
    {
        $this->packer = new Packer(null, [new ProductExtension()]);
        $this->unpacker = new BufferUnpacker('', null, [new ProductExtension()]);
    }

    /**
     * @param mixed $data
     *
     * @return false|string|null
     */
    public function pack($data)
    {
        return $this->packer->pack($data);
    }

    /**
     * @param string $packedData
     *
     * @return array|bool|\GMP|int|\MessagePack\Ext|mixed|resource|string|null
     */
    public function unpack(string $packedData)
    {
        return $this->unpacker->append($packedData)->unpack();
    }
}
