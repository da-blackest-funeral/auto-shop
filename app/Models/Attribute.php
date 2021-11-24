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
        'updated_at',
        'pivot',
    ];

    /*
     * TODO сделать autopart_id в таблице attributes
     * и связсь один ко многим
    */
    public function autoparts()
    {
        return $this->belongsToMany(Autopart::class, 'attribute_autopart');
    }
}
