<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 17:34
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;

class SaveBrokerRole
{
    public function  handle(UserPub $user){
        $user->roles()->sync(
            [0 => 2 ]
        );
    }
}
