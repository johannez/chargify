<?php

namespace Chargify\Tests;
use \Chargify\Controller\Factory;
use \Chargify\Controller\Product;
use \Chargify\Resource\ProductResource;
use \PHPUnit_Framework_TestCase;

class ProductControllerTest extends PHPUnit_Framework_TestCase {

  public function testGetAll() {
    $controller = Factory::build('product', $GLOBALS['chargify_domain'], $GLOBALS['chargify_api_key']);
    $this->assertNotEmpty($controller->getAll());
  }

  /**
   * @depends testGetAll
   */
  public function testGetByFamily() {
    $controller = Factory::build('product', $GLOBALS['chargify_domain'], $GLOBALS['chargify_api_key']);
    $products = $controller->getAll();

    $this->assertNotEmpty($controller->getByFamily($products[0]->product_family->id));
  }

  /**
   * @depends testGetAll
   */
  public function testGetById() {
    $controller = Factory::build('product', $GLOBALS['chargify_domain'], $GLOBALS['chargify_api_key']);
    $products = $controller->getAll();

    $response = $controller->getById($products[0]->id);

    $this->assertNotNull($response);
    $this->assertInstanceOf('Chargify\Resource\ProductResource', $response);
  }

  /**
   * @depends testGetAll
   */
  public function testGetByHandle() {
    $controller = Factory::build('product', $GLOBALS['chargify_domain'], $GLOBALS['chargify_api_key']);
    $products = $controller->getAll();

    $response = $controller->getByHandle($products[0]->handle);

    $this->assertNotNull($response);
    $this->assertInstanceOf('Chargify\Resource\ProductResource', $response);
  }

  /**
   * @depends testGetByFamily
   */
  public function testCreateProduct() {

    $controller = Factory::build('product', $GLOBALS['chargify_domain'], $GLOBALS['chargify_api_key']);
    $products = $controller->getAll();

    $data = array(
      'product' => array(
        'name' => 'Basic Plan 123',
        'handle' => 'basic',
        'description' => 'This is our basic plan.',
        'accounting_code' => '123',
        'request_credit_card' => true,
        'price_in_cents' => 1000,
        'interval' => 1,
        'interval_unit' => 'month'
      )
    );

    $response = $controller->create($products[0]->product_family->id, $data);

    $this->assertNotNull($response);
    $this->assertInstanceOf('Chargify\Resource\ProductResource', $response);
  }

}