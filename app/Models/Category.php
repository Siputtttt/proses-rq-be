<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'm_categories';
    protected $fillable = ['name'];
    
    public $timestamps = false;
}
