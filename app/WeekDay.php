<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeekDay extends Model
{
    protected $fillable = ['day_number', 'name', 'abbreviation'];

    /**
     * Relationship: Specials
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specials()
    {
        return $this->hasMany(Special::class, 'week_day_id');
    }
}
