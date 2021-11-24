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

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_autopart');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'autopart_cars');
    }
}
