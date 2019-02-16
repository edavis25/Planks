<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $fillable = ['description', 'price', 'week_day_id'];

    /**
     * Relationship: Weekday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function weekday()
    {
        return $this->belongsTo(WeekDay::class, 'week_day_id');
    }
}
