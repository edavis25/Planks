<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationCode extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['code', 'used', 'created_by_user_id', 'code_used_by_user_id'];

    public function created_by() {
        return $this->belongsTo('User', 'created_by_user_id', 'id');
    }

    public function used_by() {
        return $this->belongsTo('User', 'code_used_by_user_id', 'id');
    }
}
