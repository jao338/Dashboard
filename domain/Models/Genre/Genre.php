<?php

namespace Domain\Models\Genre;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre {
    use HasFactory;

    protected        $table        = 'genres';
    protected $primaryKey   = 'id_genre';
    public           $incrementing = true;

    protected $casts  = [
        'id_genre'    => 'integer',
    ];

    protected $fillable = [
        'name',
        'icon',
    ];

}
