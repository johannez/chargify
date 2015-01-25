<?php

namespace Chargify\Controller;

use \Chargify\Resource\ComponentResource as Resource;

class Component extends AbstractController
{

    /**
     * Get all components for a product family.
     *
     * @param int $id Product family id.
     * @return    component objects
     */
    public function getDefinitions($id)
    {
        $components = array();
        // Get the raw data from Chargify.
        $response = $this->request('product_families/' . $id . '/components');

        // Convert the raw data into resource objects.
        foreach ($response as $data ) {
            if (is_array($data) && is_array($data['component'])) {
                $components[] = new Resource($data['component']);
            }
        }

        return $components;
    }

    /**
     * Returns a component by product family and id.
     *
     * @param    $family_id The product family id.
     * @param    $component_id The component id.
     * @return    A chargify component object.
     */
    public function getDefinitionById($family_id, $component_id)
    {
        $component = null;

        $response = $this->request('product_families/' . $family_id . '/components/' . $component_id);

        if (is_array($response) && is_array($response['component'])) {
            $component = new Resource($response['component']);
        }

        return $component;
    }

    /**
     * Get all components for a subscription.
     *
     * @param int $id subscription id.
     * @return    component objects
     */
    public function getLineItems($id)
    {
        $components = array();
        // Get the raw data from Chargify.
        $response = $this->request('subscriptions/' . $id . '/components');

        // Convert the raw data into resource objects.
        foreach ($response as $data ) {
            if (is_array($data) && is_array($data['component'])) {
                $components[] = new Resource($data['component']);
            }
        }

        return $components;
    }

    /**
     * Get all components for a subscription.
     *
     * @param int $subscription_id subscription id.
     * @param int $component_id component id.
     * @return    component object
     */
    public function getLineItemById($subscription_id, $component_id)
    {
        $component = NULL;

        $response = $this->request('subscriptions/' . $subscription_id . '/components/' . $component_id);

        if (is_array($response) && is_array($response['component'])) {
            $component = new Resource($response['component']);
        }

        return $component;
    }

    /**
     * Create a new component.
     *
     * @param    $family_d Product family id.
     * @param    $plural_kind    The endpoint for the type of component you want to create.
     * Valid values: metered_components, quantity_based_components, on_off_components
     * @param    $data Keyed array of data according to API docs.
     * @return    Newly created chargify object.
     */
    public function create($family_id, $plural_kind, $data)
    {
        $component = null;

        $response = $this->request('product_families/' . $family_id . '/' . $plural_kind, $data, 'POST');

        if (is_array($response) && is_array($response['component'])) {
            $component = new Resource($response['component']);
        }

        return $component;
    }

}