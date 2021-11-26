<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'article',
        'category_id'
    ];

    protected $hidden = [
        'pivot',
        'updated_at'
    ];

    public function attributes(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Attribute::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function cars(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Car::class, 'autopart_cars');
    }
}
