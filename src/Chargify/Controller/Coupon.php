<?php

namespace Chargify\Controller;

use \Chargify\Resource\CouponResource as Resource;

class Coupon extends AbstractController {

  /**
   * Return all coupons.
   *
   * @return  List of chargify coupon objects.
   */
  public function getAll() {
    $coupons = array();
    // Get the raw data from Chargify.
    $response = $this->request('coupons');

    // Convert the raw data into resource objects.
    foreach ($response as $data ) {
      if (is_array($data) && is_array($data['coupon'])) {
        $coupons[] = new Resource($data['coupon']);
      }
    }

    return $coupons;
  }

  /**
   * Read a coupon by id.
   *
   * @param $id The coupon ID.
   * @return A coupon object.
   */
  public function getById($id) {
    $coupon = null;

    $response = $this->request('coupons/' . $id);

    if (is_array($response) && is_array($response['coupon'])) {
      $coupon = new Resource($response['coupon']);
    }

    return $coupon;
  }

  /**
   * Find a coupon by code.
   *
   * @param $code The coupon code.
   * @return A coupon object.
   */
  public function getByCode($code) {
    $coupon = null;

    $response = $this->request('coupons/find?code=' . $code);

    if (is_array($response) && is_array($response['coupon'])) {
      $coupon = new Resource($response['coupon']);
    }

    return $coupon;
  }

  /**
   * Creates a chargify coupon.
   *
   * @param  $data Keyed array of data according to API docs.
   * @return  Newly created chargify object.
   */
  public function create($data) {
    $coupon = null;

    $response = $this->request('coupons', $data, 'POST');

    if (is_array($response) && is_array($response['coupon'])) {
      $coupon = new Resource($response['coupon']);
    }

    return $coupon;
  }

  /**
   * Updates a chargify coupon.
   *
   * @param  $id coupon id.
   * @param  $data Keyed array of data according to API docs.
   * @return  Newly created chargify object.
   */
  public function update($id, $data) {
    $coupon = null;

    $response = $this->request('coupons/' . $id, $data, 'PUT');

    if (is_array($response) && is_array($response['coupon'])) {
      $coupon = new Resource($response['coupon']);
    }

    return $coupon;
  }

  /**
   * Archive a coupon.
   *
   * @param $id The Chargify coupon ID.
   */
  public function archive($id) {
    $coupon = null;

    $response = $this->request('coupons/' . $id, array(), 'DELETE');

    if (is_array($response) && is_array($response['coupon'])) {
      $coupon = new Resource($response['coupon']);
    }

    return $coupon;
  }

  /**
   * Validate a coupon code.
   *
   * @param $code The coupon code.
   * @return  array Either error message or the coupon object on success.
   */
  public function validate($code) {
    $coupon = null;

    $response = $this->request('coupons/validate?code=' . $code);

    if (is_array($response) && is_array($response['coupon'])) {
      $coupon = new Resource($response['coupon']);
    }

    return $coupon;
  }

  /**
   * Get usage stats for a coupon.
   *
   * @param $id The Chargify coupon ID.
   * @return  array Details about the coupon usage as an array of data hashes, one per product.
   */
  public function usage($id) {
    return $this->request('coupons/' . $id . '/usage');
  }

}