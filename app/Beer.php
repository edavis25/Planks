<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
