<?php


namespace Chargify\Resource;

class PriceResource extends AbstractResource {

  public $starting_quantity;
  public $ending_quantity;
  public $unit_price;

  public function getName() {
    return 'price';
  }

}