Chargify API
===

This library provides you with functionality to interact with the
[Chargify](http://chargify.com/) payment platform. It's built according to
the [Chargify API](http://docs.chargify.com/api-introduction) version 1.

### Supported Resources

- Products
- Customers
- Subscriptions
- Coupons
- Components
- Transactions

### Roadmap

- Implement PHPUnit tests for the supported resources.
- Add more resources from the Chargify API.

### Installation

Easiest way would be using [Composer](http://getcomposer.org) and adding this to
the composer.json requirement section.

```json
{
  "require": {
    "johannez/chargify": "dev-master"
  }
}
```

It's PSR-0 compliant, so you can also use your own custom autoloader.

### Usage

In general, every resource has a controller and a resource class. The
controller is used to send requests to Chargify and the resource classes map
the response data.

Only thing you really need is a controller for the resource you want to work
with:

```php
<?php
// $type Singular lower-case name of a suported resource
// $domain Unique sub-domain name (https://DOMAIN.chargify.com)
// $api_key API key that you get through your Chargify environment.
$controller = new \Chargify\Controller\Factory::build($type, $domain, $api_key);
```

For example to get a listing of all products in the system:
```php
<?php

$pc = new \Chargify\Controller\Factory::build('product', YOUR_DOMAIN, YOUR_API_KEY);
$products = $pc->getAll();
```

Sending data to Chargify is easy as well.
```php
<?php

$data = array(
  'customer' => array(
    'first_name' => 'Joe',
    'last_name' => 'Smith',
    'email' => 'joe4@example.com',
    'organization' => 'Example Corp.',
    'reference' => 'js21',
  )
);

$cc = new \Chargify\Controller\Factory::build('customer', YOUR_DOMAIN, YOUR_API_KEY);
$new_customer = $cc->create($data);
```

