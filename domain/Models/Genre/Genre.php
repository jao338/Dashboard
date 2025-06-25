<?php

namespace Domain\Models\Genre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model {
    use HasFactory;

    protected $table        = 'genres';
    protected $primaryKey   = 'id_genre';
    protected $keyType = 'int';

    public    $incrementing = true;

    protected $casts = [
        'id_genre' => 'integer',
    ];

    protected $fillable = [
        'name',
        'icon',
    ];

    protected static function newFactory()
    {
        return GenreFactory::new();
    }

    protected static function booted()
    {
        static::creating(function (Genre $genre) {
            if (empty($user->uuid)) {
                $genre->uuid = \Str::uuid();
            }
        });
    }

}
