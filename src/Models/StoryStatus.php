<?php
namespace Masterix21\LaravelBoilerplate\Models;

use Illuminate\Database\Eloquent\Model;

class StoryStatus extends Model
{
    protected $fillable = [
        'name',
        'model_type',
        'is_default',
        'events',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'events' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stories()
    {
        return $this->hasMany(Story::class, 'status_id');
    }
}
