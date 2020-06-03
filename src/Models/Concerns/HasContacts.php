<?php
namespace Masterix21\LaravelBoilerplate\Models\Concerns;

use Masterix21\LaravelBoilerplate\Models\Address;
use Masterix21\LaravelBoilerplate\Models\Contact;

trait HasContacts
{
    /**
     * Addresses
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'model');
    }

    /**
     * Shipment contacts only
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function billingContacts()
    {
        return $this->contacts()->where('is_billing', true);
    }

    /**
     * Shipment contacts only
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function shipmentContacts()
    {
        return $this->contacts()->where('is_shipping', true);
    }
}

