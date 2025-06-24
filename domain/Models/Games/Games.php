<?php

namespace Domain\Models\Games;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model {

    use HasFactory;

    protected $table      = 'games';
    protected $primaryKey = 'id_game';
    protected $keyType = 'int';

    public $incrementing   = true;

    protected $casts  = [
        'appid'  => 'int',
        'active' => 'boolean',
    ];

    protected $fillable = [
        'appid',
        'name',
        'icon',
        'last_synced_at',
        'max_players_daily',
        'active',
    ];

    public static function syncFromSteam(array $gameData): void
    {
        static::updateOrCreate(
            [
                'max_players_daily' => $gameData['max_players_daily'],
                'last_synced_at'    => now(),
            ]
        );
    }


    protected static function newFactory()
    {
        return GamesFactory::new();
    }

    protected static function booted()
    {
        static::creating(function (Games $game) {
            if (empty($game->uuid)) {
                $game->uuid = \Str::uuid();
            }
        });
    }
}
