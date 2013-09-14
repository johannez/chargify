<?php

namespace Chargify\Resource;

class ProductFamily extends AbstractResource {
    public $name;
    public $handle;
    public $id;
    public $accounting_code;
    public $description;

    public function getName() { return 'product_family'; }
}