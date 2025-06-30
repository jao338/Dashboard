<?php

namespace Domain\Models\Games;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    use HasFactory;

    protected $table      = 'games';
    protected $primaryKey = 'id_game';
    protected $keyType = 'int';

    public $incrementing   = true;

    protected $casts  = [
        'appid'             => 'int',
        'active'            => 'boolean',
        'max_players_daily' => 'int',
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
        $game = static::firstOrNew(['appid' => $gameData['id']]);

        if (!$game->exists || empty($game->name)) {
            $game->name = $gameData['name'];
        }

        if (!$game->exists || empty($game->icon)) {
            $game->icon = $gameData['icon'] ?? null;
        }

        $game->max_players_daily = $gameData['number_of_players'] ?? null;
        $game->last_synced_at    = now();
        $game->active            = true;

        $game->save();
    }


    protected static function newFactory()
    {
        return GameFactory::new();
    }

    protected static function booted()
    {
        static::creating(function (Game $game) {
            if (empty($game->uuid)) {
                $game->uuid = \Str::uuid();
            }
        });
    }
}
