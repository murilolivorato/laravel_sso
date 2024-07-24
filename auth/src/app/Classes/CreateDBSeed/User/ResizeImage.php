<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 00:40
 */

namespace App\Classes\CreateDBSeed\User;
use Image;

class ResizeImage
{
    public static function process($oldlocation , $newlocation , $size){
        // create new image with transparent background color
        $background = Image::canvas($size, $size);

        $image = Image::make($oldlocation)->resize($size, $size, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });

        // insert resized image centered into background
        $background->insert($image, 'center');

        // save or do whatever you like
        $background->save($newlocation);
    }


}