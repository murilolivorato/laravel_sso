<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 19:11
 */

namespace App\Classes\CreateDBSeed\User\User;

use App\Models\UserPub;
use App\Classes\CreateDBSeed\DB\DBUserConstructorProfile;
use App\Classes\ImageResize\SquareImage;
use App\Classes\Helper\MakeFileName;
use File;
use App\Models\UserPresentationImage;


class UploadConstructorImageProfile
{
    public function  handle(UserPub $user){

        $list = DBUserConstructorProfile::all();
        $order = $user->ConstructorInfo->id - 1;

        $this->uploadImageProfile($list[$order] , $user );

    }

    // UPLOAD IMAGE
    public function uploadImageProfile($list , UserPub $user){

        $oldName    = $list['image'];
        $newName    =  MakeFileName::encriptName($oldName);

        $oldlocation = public_path("/assets/create/constructor/" . $oldName);
        $newlocation = public_path($user->UserPubPathProfileURL . "/" . $newName);

        SquareImage::process($oldlocation , $newlocation , 480);

        // UPLOAD THUMB
        $this->uploadImageThumbProfile($newName   , $user );

        // SAVE IN DB
        $this->saveImageDB($newName   , $user);
    }

    public function uploadImageThumbProfile($imageName  , UserPub $user ){

        $oldlocation = public_path($user->UserPubPathProfileURL . "/" . $imageName);
        $newlocation = public_path($user->UserPubPathProfileURL . "/" . MakeFileName::makeThumb($imageName));

        SquareImage::process($oldlocation , $newlocation , 280);

    }

    public function saveImageDB($imageName  , UserPub $user ){
        $user->Presentation->Image()->save(
            factory(UserPresentationImage::class)->make([
                'user_id' => $user->id ,
                'image'   => $imageName
            ])
        );
    }
}
