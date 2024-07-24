<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 09/03/2019
 * Time: 10:02
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use App\Models\UserAddress;

class SaveAddress
{
    public function  handle(UserPub $user){
        // ADDRESS
        $user->Address()->save(
            factory(UserAddress::class)->make()
        );
    }
}
