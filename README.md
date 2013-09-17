Chargify API
===

This library provides you with functionality to interact with the
[Chargify](http://chargify.com/) payment platform. It's build according to
the [Chargify API](http://doc.chargify.com) version 1.

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

Easiest way would be using [Composer](http://getcomposer.org) and this to
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
$controller = new \Chargify\Controller\Factory::build(TYPE, DOMAIN, API_KEY);
```

TYPE is the singular lower-case name of a suported resource
DOMAIN is your unique sub-domain name (https://DOMAIN.chargify.com)
API_KEY is the API key that you get through your Chargify environment.


