<?php

namespace Chargify\Controller;

use \Chargify\Resource\ComponentResource as Resource;

class Component extends AbstractController {

  /**
   * Get all component for a product family.
   *
   * @param int $id Product family id.
   * @return  component objects
   */
  public function getAll($id) {
    $components = array();
    // Get the raw data from Chargify.
    $response = $this->request('product_families/' . $id . '/components');

    // Convert the raw data into resource objects.
    foreach ($response as $data ) {
      if (is_array($data) && is_array($data['component'])) {
        $components[] = new Resource($data['component']);
      }
    }

    return $components;
  }

}