<?php

namespace Domain\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasFactory, HasApiTokens;

    protected $table      = 'users';
    protected $primaryKey = 'id_user';
    protected $keyType = 'int';

    public $incrementing   = true;

    protected $casts  = [
        'access_type'           => 'integer',
        'telephony'             => 'integer',
        'email_verified_at'     => 'datetime',
        'password'              => 'hashed',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'telephony',
        'access_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setActiveToken(string $token): void
    {
        $this->activeToken = $token;
    }

    public function getActiveToken(): string|null
    {
        return $this->activeToken ?? null;
    }

    public function getRouteKeyName(): string
    {
        return 'id_user';
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    protected static function booted()
    {
        static::creating(function (User $user) {
            if (empty($user->uuid)) {
                $user->uuid = \Str::uuid();
            }
        });
    }


}
