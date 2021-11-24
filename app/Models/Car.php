<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// TODO убрать из таблицы машин регистрационный номер и год выпуска.

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'registration_number',
        'brand',
        'year'
    ];

    protected $hidden = [
      'pivot',
      'updated_at'
    ];

    public function autoparts()
    {
        return $this->belongsToMany(Autopart::class, 'autopart_cars');
    }
}
