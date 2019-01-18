<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuImage extends Model
{
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'filename',
        'filepath',
        'filetype',
        'size',
        'disk',
        'uuid'
    ];

    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
