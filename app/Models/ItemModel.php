<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;

    protected $collection = 'item';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id'
    ];
}
