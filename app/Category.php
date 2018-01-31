<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    public function beers() {
        return $this->hasMany('App\Beer');
    }
}
