<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryModel extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    
    protected $collection = 'category';

    protected $fillable = [
        'name',
        'description'
    ];
}
