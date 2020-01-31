<?php

declare(strict_types=1);

namespace App\Service\GoogleProtobuf\Model;

use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>App.Service.GoogleProtobuf.Model.Product</code>.
 */
class Product extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string id = 1;</code>.
     *
     * @var string
     */
    protected string $id = '';

    /**
     * Generated from protobuf field <code>string title = 2;</code>.
     *
     * @var string
     */
    protected string $title = '';

    /**
     * Generated from protobuf field <code>string description = 3;</code>.
     *
     * @var string
     */
    protected string $description = '';

    /**
     * Generated from protobuf field <code>float price = 4;</code>.
     *
     * @var float
     */
    protected float $price = 0.0;

    /**
     * Generated from protobuf field <code>bool enabled = 5;</code>.
     *
     * @var bool
     */
    protected bool $enabled = false;

    /**
     * Constructor.
     *
     * @param array $data
     *
     * @var string $id
     * @var string $title
     * @var string $description
     * @var float  $price
     * @var bool   $enabled
     *             }
     */
    public function __construct($data = null)
    {
        \App\Service\GoogleProtobuf\GPBMetadata\Product::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>.
     *
     * @param string $var
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setId(string $var): self
    {
        GPBUtil::checkString($var, true);
        $this->id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string title = 2;</code>.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Generated from protobuf field <code>string title = 2;</code>.
     *
     * @param string $var
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setTitle(string $var): self
    {
        GPBUtil::checkString($var, true);
        $this->title = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string description = 3;</code>.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Generated from protobuf field <code>string description = 3;</code>.
     *
     * @param string $var
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setDescription(string $var): self
    {
        GPBUtil::checkString($var, true);
        $this->description = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>float price = 4;</code>.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Generated from protobuf field <code>float price = 4;</code>.
     *
     * @param float $var
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setPrice(float $var): self
    {
        GPBUtil::checkFloat($var);
        $this->price = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool enabled = 5;</code>.
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Generated from protobuf field <code>bool enabled = 5;</code>.
     *
     * @param bool $var
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setEnabled($var): self
    {
        GPBUtil::checkBool($var);
        $this->enabled = $var;

        return $this;
    }
}
