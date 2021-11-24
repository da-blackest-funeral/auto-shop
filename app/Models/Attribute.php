<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'value',
        'description'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function autoparts()
    {
        return $this->belongsToMany(Autopart::class, 'attribute_autopart');
    }
}
