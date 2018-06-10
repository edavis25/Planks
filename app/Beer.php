<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'description', 'price', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
