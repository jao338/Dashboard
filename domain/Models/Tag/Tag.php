<?php

namespace Domain\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    use HasFactory;

    protected $table        = 'tags';
    protected $primaryKey   = 'id_tag';
    protected $keyType = 'int';

    public    $incrementing = true;

    protected $casts = [
        'id_tag' => 'integer',
    ];

    protected $fillable = [
        'name',
        'icon',
    ];

    protected static function newFactory()
    {
        return TagFactory::new();
    }

    protected static function booted()
    {
        static::creating(function (Tag $tag) {
            if (empty($user->uuid)) {
                $tag->uuid = \Str::uuid();
            }
        });
    }

}
