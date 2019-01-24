<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class ImageUploadService
{
    /** @var \Illuminate\Http\UploadedFile */
    protected $uploaded_file;

    /** @var string */
    protected $storage_path;

    /** @var \Intervention\Image\Image */
    protected $image;

    /** @var \Intervention\Image\ImageManager */
    protected $image_manager;

    /**
     * ImageUploadService constructor.
     * @param UploadedFile $image
     * @param string       $storage_path
     * @param array        $manager_opts
     */
    public function __construct(UploadedFile $image, string $storage_path, array $manager_opts = [])
    {
        $this->uploaded_file = $image;
        $this->storage_path  = $storage_path;
        $this->image_manager = new ImageManager($manager_opts);
        $this->image = $this->makeImage($image);
    }

    /**
     * Save an uploaded image & thumbnail version
     *
     * @return Image
     */
    public function processImage()
    {
        $filename = $this->uploaded_file->getClientOriginalName();

        if ($this->image->getWidth() > config('menu_images.metadata.max_width')) {
            $this->resizeToMaxWidth(config('menu_images.metadata.max_width'));
        }

        $this->saveImageToDisk($filename);

        $this->createThumbnail($filename);

        return $this->image;
    }

    /**
     * Make Image From Uploaded File
     *
     * @param UploadedFile $image
     * @return Image
     */
    private function makeImage(UploadedFile $image) : Image
    {
        return $this->image_manager->make($image);
    }

    /**
     * Validate the image against rules set in menu_images.php config
     * @note: validates size & mime type
     *
     * @return bool
     */
    public function validImage() : bool
    {
        if (! in_array($this->image->mime, config('menu_images.metadata.valid_extensions'))) {
            return false;
        }

        if ($this->image->filesize() > config('menu_images.metadata.max_filesize')) {
            return false;
        }

        return true;
    }

    public function cropImage(int $width, int $height) : Image
    {
        return $this->image->crop($width, $height);
    }

    /**
     * Get Image
     *
     * @return \Intervention\Image\Image
     */
    public function getImage() : Image
    {
        return $this->image;
    }

    /**
     * Save The Image to Disk
     *
     * @param  string $filename
     * @return Image
     */
    public function saveImageToDisk(string $filename)
    {
        $save_path = $this->storage_path;

        if (! file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }

        if (substr($save_path, -1) != DIRECTORY_SEPARATOR) {
            $save_path .= DIRECTORY_SEPARATOR;
        }

        $save_path .= $filename;
        return $this->image->save($save_path);
    }

    /**
     * Create thumbnail version of image
     *
     * @param string $filename
     * @return Image
     */
    public function createThumbnail(string $filename) : Image
    {
        $width  = config('menu_images.thumbnail.dimensions.width');
        $height = config('menu_images.thumbnail.dimensions.height');
        $this->cropImage($width, $height);

        $name = config('menu_images.thumbnail.prefix') . $filename;
        return $this->saveImageToDisk($name);
    }

    /**
     * Resize an image to a max width while preserving aspect ratio
     *
     * @param $max_width
     * @return Image
     */
    public function resizeToMaxWidth($max_width)
    {
        return $this->image->resize($max_width, null, function ($constraint) {
            return $constraint->aspectRatio();
        });
    }
}