<?php

namespace Domain\Models\User;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasFactory, HasUuids, HasApiTokens;

    protected $table      = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;

    protected $casts  = [
        'access_type' => 'integer',
        'id_user'     => 'integer',
        'telephony'   => 'integer'
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

}
