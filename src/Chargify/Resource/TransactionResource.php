<?php


namespace Chargify\Resource;

class TransactionResource extends AbstractResource
{
    public $amount_in_cents;
    public $created_at;
    public $ending_balance_in_cents;
    public $id;
    public $kind;
    public $memo;
    public $payment_id;
    public $product_id;
    public $starting_balance_in_cents;
    public $subscription_id;
    public $success;
    public $type;
    public $transaction_type;
    public $gateway_transaction_id;

    public function getName()
    {
        return 'transaction';
    }

    public function getFilter()
    {
        return array(
            'created_at' => function($value) { return new \DateTime($value); },
        );
    }
}