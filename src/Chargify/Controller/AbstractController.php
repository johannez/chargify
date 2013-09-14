<?php

namespace Chargify\Controller;

abstract class AbstractController {
  protected $client;


  public function __construct(\Guzzle\Http\ClientInterface $client)
  {
    if (empty($client)) {
      throw new Exception(t('Cannot create a controller instance without a specified REST client.'));
    }

    $this->client = $client;
  }

  protected function request($uri, $body = array(), $method = 'GET') {
    $data = NULL;

    switch ($method) {
      case 'POST':
        $request = $this->client->post($uri);
        $request->setBody(json_encode($body));
        break;

      case 'PUT':

        break;

      case 'DELETE':

        break;

      default: // GET
        $request = $this->client->get($uri);
    }

    $response = $request->send();

    if ($response->isSuccessful()) {
      $data = $response->json();
    }

    return $data;
  }

  public function getClient() {
    return $this->client;
  }

}