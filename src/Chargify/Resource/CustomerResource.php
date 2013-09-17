<?php


namespace Chargify\Resource;

class CustomerResource extends AbstractResource {
  public $first_name;
  public $last_name;
  public $address;
  public $organization;
  public $zip;
  public $state;
  public $id;
  public $country;
  public $city;
  public $reference;
  public $address_2;
  public $email;
  public $phone;
  public $created_at;
  public $updated_at;

  public function getName() {
    return 'customer';
  }

  public function getFilter() {
    return array(
      'created_at' => function($value) { return new \DateTime($value); },
      'updated_at' => function($value) { return new \DateTime($value); },
    );
  }
}