<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;

class FileUploadController extends Controller
{
    public function __construct(
        public $url, public $publicId
    ) {
        //
    }

    public static function upload($image, $folder = '')
    {
        $result = $image->storeOnCloudinary($folder);

        $pid = $result->getPublicId();
        $url = $result->getSecurePath();

        return new static($url, $pid);
    }

    public static function delete($public_id)
    {
        $ce = new CloudinaryEngine();
        $ce = $ce->destroy($public_id);
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPublicId()
    {
        return $this->publicId;
    }
}
