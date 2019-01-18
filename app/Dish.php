<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
     * Get the post's image.
     */
    public function image()
    {
        return $this->morphOne(MenuImage::class, 'imageable');
    }

    /**
     * Build Image URL
     *
     * @return string
     */
    public function imageUrl() : string
    {
        return $this->image ? $this->buildUrl($this->image) : '';
    }

    /**
     * Build Thumbnail URL
     *
     * @return string
     */
    public function thumbnailUrl() : string
    {
        return $this->image ? $this->buildUrl($this->image, true) : '';
    }

    /**
     * Helper function for building URLs
     *
     * @param MenuImage $image
     * @param bool      $thumbnail
     * @return string
     */
    public function buildUrl(MenuImage $image, $thumbnail = false)
    {
        $path = config('menu_images.storage.food.local_path');
        $filename = $thumbnail ? config('menu_images.thumbnail.prefix') . $image->filename : $image->filename;
        $path .= DIRECTORY_SEPARATOR . $this->image->uuid . DIRECTORY_SEPARATOR . $filename;

        return asset(Storage::url($path));
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
