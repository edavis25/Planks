<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'details', 'type'];

    /**
     * Relationship: Beers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beers()
    {
        return $this->hasMany('App\Beer');
    }

    /**
     * Relationship: Dishes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dishes()
    {
        return $this->hasMany('App\Dish');
    }

    /**
     * Scope: Food
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeFood(Builder $query)
    {
        return $query->where('type', 'food')
            ->whereHas('dishes');
    }

    /**
     * Scope: Drink
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeBeer(Builder $query)
    {
        return $query->where('type', 'drink')
            ->whereHas('beers');
    }
}
