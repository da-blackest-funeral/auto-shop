<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    protected $hidden = [
      'updated_at'
    ];

    public function autoparts(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Autopart::class);
    }
}
