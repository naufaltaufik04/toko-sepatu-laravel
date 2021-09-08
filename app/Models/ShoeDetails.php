<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'color', 'size', 'stock', 'weight', 'price'
    ];


    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }
}
