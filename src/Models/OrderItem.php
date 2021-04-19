<?php


namespace Splintr\PhpSdk\Models;


use Splintr\PhpSdk\Traits\ConfigTrait;

class OrderItem
{
    use ConfigTrait;

    protected $quantity;
    protected $referenceId;
    protected $title;
    protected $unitPrice;
    protected $imageUrl;
    protected $productUrl;
    protected $description;

    public function __construct($config)
    {
        $this->bindConfig($config);
    }
}