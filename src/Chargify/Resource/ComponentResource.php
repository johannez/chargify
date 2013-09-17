<?php


namespace Chargify\Resource;

class ComponentResource extends AbstractResource {

  public $id;
  public $name;
  public $pricing_scheme;
  public $unit_name;
  public $unit_price;
  public $product_family_id;
  public $price_per_unit_in_cents;
  public $kind;
  public $archived;
  public $taxable;
  public $prices;

  public function getName() {
    return 'component';
  }

}