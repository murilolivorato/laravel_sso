<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 16:51
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;

class SaveRealEstateRole
{
    public function  handle(UserPub $user){
        $user->roles()->sync(
            [0 => 1 ]
        );
    }
}
