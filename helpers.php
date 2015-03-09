<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

if( ! function_exists('upload_image'))
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
		if( ! is_null($file))
		{
			$filename = sha1($file->getClientOriginalName()) . '.' . strtolower($file->getClientOriginalExtension());

			$file->move(public_path($path), $filename);

			return $filename;
		}

		return null;
	}
}