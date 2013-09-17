<?php

namespace Chargify\Controller;

use \Chargify\Resource\TransactionResource as Resource;

class Transaction extends AbstractController {

  /**
   * Return all products.
   *
   * @return  List of chargify product objects.
   */
  public function getAll() {
    $transactions = array();
    // Get the raw data from Chargify.
    $response = $this->request('transactions');

    // Convert the raw data into resource objects.
    foreach ($response as $data ) {
      if (is_array($data) && is_array($data['transaction'])) {
        $transactions[] = new Resource($data['transaction']);
      }
    }

    return $transactions;
  }

}