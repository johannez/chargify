<?php

namespace Chargify\Controller;

use Guzzle\Http\Client;
use Guzzle\Plugin\CurlAuth\CurlAuthPlugin;
use Exception;

class Factory
{
  public static function build($type, $domain, $api_key) {

    // Get the base url for all the connections.
    $base_url = sprintf('https://%s.chargify.com', $domain);

    // Set the response format through the header.
    $header = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json'
    );

    // Add the same basic authentication to all requests.
    $basicAuth = new CurlAuthPlugin($api_key, 'x');

    $client = new Client($base_url);
    $client->addSubscriber($basicAuth);
    $client->setDefaultHeaders($header);

    $class_name = 'Chargify\\Controller\\' . ucfirst($type);

    if (class_exists($class_name)) {
      return new $class_name($client);
    }
    else {
      throw new Exception("Invalid controller type given.");
    }
  }
}