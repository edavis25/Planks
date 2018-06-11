<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'description', 'price', 'category_id'];


    /**
    * Eloquent Relationships
    *
    */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Query Scope: Filter the Dish by Category ID
     *
     * @param Builder  $query
     * @param int|null $category_id
     *
     * @return Builder
     */
    public function scopeFilterByCategory(Builder $query, $category_id = null)
    {
        if ($category_id) {
            return $query->whereHas('category', function ($q) use ($category_id) {
                return $q->where('id', $category_id);
            });
        }

        return $query;
    }
}
