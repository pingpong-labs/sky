<?php

use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

if ( ! function_exists('upload_image'))
{
    /**
     * Upload image and get image filename.
     *
     * @param  UploadedFile $file
     * @param  string $path
     * @return string
     */
    function upload_image($file, $path)
    {
        if ( ! is_null($file))
        {
            $filename = sha1(time() . $file->getClientOriginalName()) . '.' . strtolower($file->getClientOriginalExtension());

            $file->move(public_path($path), $filename);

            return $filename;
        }

        return null;
    }
}

if ( ! function_exists('set_active'))
{
    /**
     * Set active to specified selector.
     *
     * @param array|string $paths
     * @param string $class
     * @return string
     */
    function set_active($paths, $class = 'active')
    {
        foreach ((array)$paths as $path)
        {
            if (Request::is($path))
            {
                return $class;
            }
        }
    }
}
