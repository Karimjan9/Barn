<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemUnityModel extends Model
{
    use HasFactory;
    protected $table='item_unity';

    protected $fillable=[
        'name'
    ];
}
