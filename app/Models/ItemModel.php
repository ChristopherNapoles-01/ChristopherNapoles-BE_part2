<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'item';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id'
    ];
}
