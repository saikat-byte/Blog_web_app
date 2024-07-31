<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PhotoUploadController extends Controller
{
    public function imageUpload( string $name, int $height, int $width, string $path, $file) : string
    {


        $manager = new ImageManager(new Driver());
        $image_name = $name.'.webp';
        $image = $manager->read($file);
        $image =  $image->resize($width, $height );
        $image->toWebp(50)->save(public_path($path).'/'.$image_name);

        return  $image_name;
    }

    public function imageUnlink($path, $name): void
    {

        $image_path = \public_path($path).$name;

        if (\file_exists( $image_path)) {
           \unlink($image_path);
        }
    }
}
