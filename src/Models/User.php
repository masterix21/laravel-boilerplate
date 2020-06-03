<?php
namespace Masterix21\LaravelBoilerplate\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Masterix21\LaravelBoilerplate\Models\Concerns\HasAddresses;
use Masterix21\LaravelBoilerplate\Models\Concerns\HasContacts;
use Masterix21\LaravelBoilerplate\Models\Concerns\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable, HasRoles, HasAddresses, HasTags, HasContacts, InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile',
        'tax_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'display_name',
        'avatar_url',
        'avatar_thumb_url',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(72)
            ->height(72);
    }

    /**
     * @return string
     */
    public function getDisplayNameAttribute() : string
    {
        return trim($this->first_name .' '. $this->last_name);
    }

    /**
     * Avatar a dimensione originale
     *
     * @return string
     */
    public function getAvatarUrlAttribute() : string
    {
        if (! $this->hasMedia('avatar')) {
            return gravatar($this->email);
        }

        return $this->getFirstMedia('avatar')->getUrl();
    }

    /**
     * Avatar a dimensione thumb
     *
     * @return string
     */
    public function getAvatarThumbUrlAttribute() : string
    {
        if (! $this->hasMedia('avatar')) {
            return gravatar($this->email);
        }

        return $this->getFirstMedia('avatar')->getUrl('thumb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialAccounts()
    {
        return $this->hasMany(UserSocialAccount::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
            ->using(CartProduct::class)
            ->withPivot([
                'key',
                'quantity',
                'attributes',
                'created_at',
                'updated_at',
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Verifica se l'utente è un cowboy
     *
     * @return bool
     */
    public function isCowboy()
    {
        return $this->hasRole('cowboy');
    }
}

