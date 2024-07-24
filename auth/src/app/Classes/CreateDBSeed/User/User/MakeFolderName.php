<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 16:54
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use Vinkla\Hashids\Facades\Hashids;
use File;

class MakeFolderName
{
    public function  handle(UserPub $user){

        // FOLDER NAME
        $folder_name =   Hashids::connection('user_folder')->encode($user->id);

        // CHANGE FOLDER USER DB
        $this->changeFolderDBName($folder_name , $user);

        // MAKE FILE DIRECTORY
        $this->makeFileDirectory($user);
    }

    public function changeFolderDBName($folder_name , UserPub $user){
        // change user folder name
        $user->folder = $folder_name;
        $user->code   = $folder_name;
        $user->save();
    }



    public function makeFileDirectory(UserPub $user){
        // MAKE DIRECTORY IN BROKER FOLDDER
        File::makeDirectory( public_path($user->UserPubPathURL) , 0777, true);

        File::makeDirectory( public_path($user->UserPubPathProfileURL ) , 0777, true);
        File::makeDirectory( public_path($user->UserPubPatPropertiesURL) , 0777, true);
    }

}
