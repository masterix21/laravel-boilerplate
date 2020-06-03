<?php
namespace Masterix21\LaravelBoilerplate\Models;

use Illuminate\Database\Eloquent\Model;
use Masterix21\LaravelBoilerplate\Models\Concerns\HasContacts;
use Masterix21\LaravelBoilerplate\Models\Concerns\HasTags;

class Address extends Model
{
    use HasTags, HasContacts;

    protected $fillable = [
        'model_type',
        'model_id',
        'label',
        'is_primary',
        'is_billing',
        'is_shipping',
        'address',
        'postal_code',
        'city',
        'province',
        'region',
        'country_code',
        'latitude',
        'longitude',
        'tax_id',
        'vat_no',
        'sdi_code',
        'pec',
    ];

    protected $casts = [
        'is_primary' => 'bool',
        'is_billing' => 'bool',
        'is_shipping' => 'bool',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    public function __toString()
    {
        return collect($this->toArray())
            ->only(['label', 'address', 'postal_code', 'city', 'province', 'region', 'country_code'])
            ->reject(fn ($field) => blank($field))->join(' - ');
    }
}
