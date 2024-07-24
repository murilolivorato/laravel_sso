<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 17:51
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;

use File;
use App\Classes\CreateDBSeed\DB\DBUserBrokerProfiles;
use App\Classes\ImageResize\ImagePicture;
use App\Classes\Helper\MakeFileName;
use App\Models\UserBrokerInfo;
use App\Models\UserPresentationImage;



class UploadBrokerImageProfile
{
    public function  handle(UserPub $user){
        $list = DBUserBrokerProfiles::all();
        $order = UserBrokerInfo::where('gender' ,$user->BrokerInfo->gender)->count() - 1 ;

        $this->uploadImageProfile($list[$order] ,  $user );
    }


    // UPLOAD IMAGE
    public function uploadImageProfile($list , UserPub $user){

        $oldName    = $list['image'];
        $newName    =  MakeFileName::encriptName($list['image']);

        $oldlocation = public_path("/assets/create/broker/" . $user->BrokerInfo->gender ."/". $oldName);
        $newlocation = public_path($user->UserPubPathProfileURL . "/" . $newName);

        ImagePicture::process($oldlocation , $newlocation , 408 , 436 );

        // UPLOAD THUMB
        $this->uploadImageThumbProfile($newName   , $user );

        // SAVE IN DB
        $this->saveImageDB($newName   , $user);

    }

    public function uploadImageThumbProfile($imageName  , UserPub $user ){

        $oldlocation = public_path($user->UserPubPathProfileURL . "/" . $imageName);
        $newlocation = public_path($user->UserPubPathProfileURL . "/" . MakeFileName::makeThumb($imageName));

        ImagePicture::process($oldlocation , $newlocation , 280 , 212 );

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
