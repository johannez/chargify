<?php

namespace Chargify\Controller;

use \Chargify\Resource\Product as Resource;

class Product extends AbstractController {

  /**
   * Return all products.
   *
   * @return  List of chargify product objects.
   */
  public function getAll() {
    $products = array();
    // Get the raw data from Chargify.
    $response = $this->request('products');

    // Convert the raw data into resource objects.
    foreach ($response as $data ) {
      if (is_array($data) && is_array($data['product'])) {
        $products[] = new Resource($data['product']);
      }
    }

    return $products;
  }


  /**
   * Returns all chargify products for a specific product family.
   *
   * @param  $id The numeric product family id.
   * @return  Array of chargify_product objects.
   */
  public function getByFamily($id) {
    $products = array();

    $response = $this->request('product_families/' . $id . '/products');

    // Convert the raw data into resource objects.
    foreach ($response as $data ) {
      if (is_array($data) && is_array($data['product'])) {
        $products[] = new Resource($data['product']);
      }
    }

    return $products;
  }

  /**
   * Returns a chargify product by ID.
   *
   * @param  $id The numeric id.
   * @return  A chargify_product object.
   */
  public function getById($id) {
    $product = null;

    $response = $this->request('products/' . $id);

    if (is_array($response) && is_array($response['product'])) {
      $product = new Resource($response['product']);
    }

    return $product;
  }

  /**
   * Returns a chargify product by handle.
   *
   * @param  $handle The handle string.
   * @return  A chargify_product object.
   */
  public function getByHandle($handle) {
    $product = null;

    $response = $this->request('products/handle/' . $handle);

    if (is_array($response) && is_array($response['product'])) {
      $product = new Resource($response['product']);
    }

    return $product;
  }

  /**
   * Creates a chargify product.
   *
   * @param  $family_id The numeric product family id.
   * @param  $data Keyed array of data according to API docs.
   * @return  Newly created chargify object.
   */
  public function create($family_id, $data) {
    $product = null;

    // TODO: Move this into the test file.
    // $data = array(
    //   'product' => array(
    //     'name' => 'Basic Plan',
    //     'handle' => 'basic',
    //     'description' => 'This is our basic plan.',
    //     'accounting_code' => '123',
    //     'request_credit_card' => true,
    //     'price_in_cents' => 1000,
    //     'interval' => 1,
    //     'interval_unit' => 'month'
    //   )
    // );

    $response = $this->request('product_families/' . $family_id . '/products', $data, 'POST');

    return $product;
  }

}