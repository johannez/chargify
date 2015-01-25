<?php


namespace Chargify\Resource;

class ComponentResource extends AbstractResource
{

    // Definition fields.
    public $id;
    public $name;
    public $pricing_scheme;
    public $unit_name;
    public $unit_price;
    public $product_family_id;
    public $price_per_unit_in_cents;
    public $kind;
    public $archived;
    public $taxable;
    public $prices;

    // Additional line item fields
    public $component_id;
    public $subscription_id;
    public $unit_balance;
    public $allocated_quantity;
    public $enabled;

    public function getName()
    {
        return 'component';
    }

}