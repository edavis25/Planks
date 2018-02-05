<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'details'];

    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    public function beers() {
        return $this->hasMany('App\Beer');
    }
}
