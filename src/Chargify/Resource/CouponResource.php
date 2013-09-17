<?php


namespace Chargify\Resource;

class CouponResource extends AbstractResource {
  public $allow_negative_balance;
  public $amount_in_cents;
  public $archived_at;
  public $code;
  public $created_at;
  public $description;
  public $duration_interval;
  public $duration_interval_unit;
  public $duration_period_count;
  public $end_date;
  public $id;
  public $name;
  public $percentage;
  public $product_family_id;
  public $recurring;
  public $start_date;
  public $updated_at;

  public function getName() {
    return 'coupon';
  }

  public function getFilter() {
    return array(
      'created_at' => function($value) { return new \DateTime($value); },
      'updated_at' => function($value) { return new \DateTime($value); },
      'start_date' => function($value) { return new \DateTime($value); },
      'end_date' => function($value) { return new \DateTime($value); },
      'archived_at' => function($value) { return new \DateTime($value); }
    );
  }
}