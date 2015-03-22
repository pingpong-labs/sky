<?php namespace Pingpong\Support;

trait ImageTrait {

    public function deleteImage()
    {
        if (file_exists($path = $this->getImagePath()))
        {
            @unlink($path);

            return true;
        }

        return false;
    }

    public function getImagePath()
    {
        return public_path(static::$path . $this->image);
    }

    public function getImageUrl()
    {
        return asset(static::$path . $this->image);
    }

    public function getImageUrlAttribute($value)
    {
        return $this->getImageUrl();
    }

    public function hasImage()
    {
        return ! empty($this->image) && file_exists($this->getImagePath());
    }

}
