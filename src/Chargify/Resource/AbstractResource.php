<?php

namespace Chargify\Resource;

abstract class AbstractResource {
  protected $data = NULL;

  /**
   * Abstract constructor
   * @param array  $data    Raw resource data array from Chargiy.
   * @param boolean $hydrate True to process the raw data.
   */
  public function __construct($data, $processData = TRUE) {
    if (empty($data)) {
      throw new \Exception(t('Cannot create a resource instance without raw data from the API.'));
    }

    $this->data = $data;

    if ($processData) {
      $this->processData();
    }
  }

  /**
   * Get the name of this resource.
   * @return string Resource name.
   */
  abstract public function getName();

  /**
   * Get the raw data from Chargify.
   * @return array Raw data.
   */
  public function getRawData() {
    return $this->data;
  }

  /**
   * Get the filter that is used in processing the raw data from Chargify.
   * @return array Processing filter.
   */
  public function getFilter() {
    return array();
  }

  /**
   * Traverse through the raw data and set the properties of this object.
   * Filter will be applied, if set.
   */
  public function processData() {
    $filter = $this->getFilter();

    foreach ($this->data as $key => $value) {
      if (property_exists($this, $key)) {
        if (is_array($value)) {
          // Must be a resource, so let's check if there is a class for this.
          $class = $this->normalizeClassName($key) . 'Resource';

          if (class_exists($class)) {
            $resource = new $class($value);
            $this->{$key} = $resource;
          }
        }
        else {
          if (isset($filter[$key]))
            $this->{$key} = $filter[$key]($value);
          else
            $this->{$key} = $value;
        }
      }
    }
  }

  /**
   * Convert the string to a valid class name.
   * @param  string $key Input key string.
   * @return string      Valid class name.
   */
  protected function normalizeClassName($key) {
    return "Chargify\\Resource\\" . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
  }
}