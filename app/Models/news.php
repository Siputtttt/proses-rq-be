<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected $table = 't_news';
    protected $fillable = ['writer', 'title', 'abstract', 'category', 'date'];
    public $timestamps = false;
}
