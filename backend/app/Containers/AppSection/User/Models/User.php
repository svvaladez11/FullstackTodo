<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\User\Observers\UserObserver;
use App\Ship\Parents\Models\ModelParent;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[\AllowDynamicProperties, ObservedBy(UserObserver::class)]
class User extends ModelParent implements Authenticatable, JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'login',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];


    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    /**
     * @phpstan-return Attribute<string|null, never>
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => is_string($value)
                ? Carbon::parse($value)->format('Y-m-d H:i:s')
                : null,
        );
    }

    /**
     * @phpstan-return Attribute<string|null, never>
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => is_string($value)
                ? Carbon::parse($value)->format('Y-m-d H:i:s')
                : null,
        );
    }

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthIdentifier(): string
    {
        return $this->id;
    }

    public function getAuthPasswordName(): string
    {
        return 'password';
    }

    /**
     * @return mixed|string
     */
    public function getAuthPassword(): mixed
    {
        return $this->password;
    }

    /**
     * @return mixed|string|null
     */
    public function getRememberToken(): mixed
    {
        return $this->attributes['remember_token'] ?? null;
    }

    public function setRememberToken($value): void
    {
        $this->attributes['remember_token'] = $value;
    }

    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
