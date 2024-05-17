<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;
    
    protected $filable = [
        'name',
        'address',
        'capacity',
        'rooms',
        'image_url',
        'price',
        'description'
    ];
}
