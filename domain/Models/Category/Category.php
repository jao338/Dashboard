<?php

namespace Domain\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;

    protected $table        = 'categories';
    protected $primaryKey   = 'id_category';
    protected $keyType = 'int';

    public    $incrementing = true;

    protected $casts = [
        'id_category' => 'integer',
    ];

    protected $fillable = [
        'name',
        'icon',
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    protected static function booted()
    {
        static::creating(function (Category $category) {
            if (empty($user->uuid)) {
                $category->uuid = \Str::uuid();
            }
        });
    }

}
