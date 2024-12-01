<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $fillable = [
        'type', 
        'address', 
        'size', 
        'bedrooms', 
        'price', 
        'latitude', 
        'longitude'
    ];
}
