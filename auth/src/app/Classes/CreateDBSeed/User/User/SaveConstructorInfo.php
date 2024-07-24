<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 19:08
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use App\Models\UserConstructorInfo;

class SaveConstructorInfo
{
    public function  handle(UserPub $user){
        // CONSTRUCTOR
        $user->ConstructorInfo()->save(
            factory(UserConstructorInfo::class)->make()
        );
    }
}
