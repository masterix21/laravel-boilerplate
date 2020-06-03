<?php
namespace Masterix21\LaravelBoilerplate\Models\Concerns;

use Masterix21\LaravelBoilerplate\Models\Address;

trait HasAddresses
{
    /**
     * Addresses
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'model');
    }

    /**
     * Legal address
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function legalAddress()
    {
        return $this->morphOne(Address::class, 'model')
            ->where('is_primary', true)
            ->where('is_billing', true);
    }

    /**
     * Shipment addresses only
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function shipmentAddresses()
    {
        return $this->addresses()->where('is_shipping', true);
    }
}

