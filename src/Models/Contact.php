<?php
namespace Masterix21\LaravelBoilerplate\Models;

use Illuminate\Database\Eloquent\Model;
use Masterix21\LaravelBoilerplate\Models\Concerns\HasTags;

class Contact extends Model
{
    use HasTags;

    protected $fillable = [
        'model_type',
        'model_id',
        'label',
        'phone',
        'email',
        'is_primary',
        'is_billing',
        'is_shipping',
    ];

    protected $casts = [
        'is_primary' => 'bool',
        'is_billing' => 'bool',
        'is_shipping' => 'bool',
    ];
}
