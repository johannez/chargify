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
        $request = $this->client->put($uri);
        $request->setBody(json_encode($body));
        break;

      case 'DELETE':
        $request = $this->client->delete($uri);
        break;

      default: // GET
        $request = $this->client->get($uri);
    }

    $response = $request->send();

    if ($response->isSuccessful()) {
      // TODO: Test if the response is JSON.
      $data = $response->json();
    }

    return $data;
  }

  public function getClient() {
    return $this->client;
  }

}