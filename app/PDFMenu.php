<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PDFMenu extends Model
{
    protected $table = 'pdf_menus';

    protected $fillable = [
        'filename',
        'filepath',
        'filetype',
        'type',
        'size'
    ];

    protected $appends = [
        'url'
    ];

    /**
     * Accessor for Generated URL
     *
     * @return string
     */
    public function getUrlAttribute() : string
    {
        return $this->getUrl();
    }

    /**
     * Build a URL for the Menu
     *
     * @return string
     */
    public function getUrl() : string
    {
        return asset(Storage::url($this->filepath)) ?? '';
    }
}
