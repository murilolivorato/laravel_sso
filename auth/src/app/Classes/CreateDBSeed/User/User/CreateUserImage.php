<?php

namespace App\Classes\CreateDBSeed\User\User;

use App\Classes\Helper\MakeFileName;
use App\Models\UserAdmin;
use App\Classes\CreateDBSeed\DB\DBUserAdminProfiles;
use File;

class CreateUserImage
{
    public  function  handle(UserAdmin $userAdmin, $gender){
        // IMAGE
        $images = DBUserAdminProfiles::all();
        // UPLOAD DETAIL
        $this->createImage($images[array_rand($images)], $userAdmin,  $gender);
    }


    // UPLOAD IMAGE
    public function createImage($list , UserAdmin $userAdmin, $gender ){
        $newImageName    =  MakeFileName::encriptName($list["image"]);
        $oldlocation = public_path("/assets/create/users/" . $gender . "/" . $list["image"]);
        $newlocation = public_path($userAdmin->PathURL . "/" . $newImageName);

        // RELOCATE , THEN SAVE IN DB
        if(File::copy($oldlocation, $newlocation)){
            $this->saveImageDB($userAdmin , $newImageName);
        }
    }


    public function saveImageDB(UserAdmin $userAdmin , $newImageName){
        // CREATE IMAGE
        $userAdmin->ImageProfile()->create([ 'image'      => $newImageName ,
                                             'user_ip'    => 1 ,
                                             'user_id'    => $userAdmin->id  ]);

    }


}
