<?php


namespace Chargify\Resource;

class CreditCardResource extends AbstractResource
{
    public $id;
    public $first_name;
    public $last_name;
    public $masked_card_number;
    public $card_type;
    public $expiration_month;
    public $expiration_year;
    public $billing_address;
    public $billing_address_2;
    public $billing_city;
    public $billing_state;
    public $billing_country;
    public $billing_zip;
    public $current_vault;
    public $vault_token;
    public $customer_vault_token;
    public $customer_id;

    public function getName()
    {
        return 'credit_card';
    }
}