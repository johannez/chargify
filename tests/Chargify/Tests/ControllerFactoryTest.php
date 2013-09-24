<?php

namespace Chargify\Tests;
use \Chargify\Controller\Factory;
use \Chargify\Controller\Product;
use \PHPUnit_Framework_TestCase;

class ControllerFactoryTest extends PHPUnit_Framework_TestCase {

  public function testDomainIsSet() {
    $this->assertTrue($GLOBALS['chargify_domain'] !== 'DOMAIN', 'Domain is not set. Please update the phpunit.xml file.');
  }

  public function testApiKeyIsSet() {
    $this->assertTrue($GLOBALS['chargify_api_key'] !== 'API_KEY', 'API key is not set. Please update the phpunit.xml file.');
  }

  /**
   * @depends testDomainIsSet
   * @depends testApiKeyIsSet
   */
  public function testCanCreateController() {
    $resource_types = array('component', 'coupon', 'customer', 'product', 'subscription', 'transaction');

    foreach ($resource_types as $type) {
      // Just take product as they are all the same.
      $controller = Factory::build($type, $GLOBALS['chargify_domain'], $GLOBALS['chargify_api_key']);

      $this->assertInstanceOf('Chargify\\Controller\\' . ucfirst($type), $controller, 'Can not initialize controller.');
    }


  }

}