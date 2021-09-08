<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'excerpt', 'description'
    ];

    public function shoeDetails()
    {
        return $this->hasMany(ShoeDetails::class);
    }
}
