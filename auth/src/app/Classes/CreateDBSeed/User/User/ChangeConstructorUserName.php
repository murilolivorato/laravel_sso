<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 19:16
 */

namespace App\Classes\CreateDBSeed\User\User;

use App\Models\UserPub;
use App\Models\UserConstructorInfo;
use App\Classes\CreateDBSeed\DB\DBUserConstructorProfile;

class ChangeConstructorUserName
{
    public function  handle(UserPub $user){

        $list = DBUserConstructorProfile::all();
        $order = $user->ConstructorInfo->id - 1;

        $user_constructor = UserConstructorInfo::find($user->ConstructorInfo->id);
        $user_constructor->company_name = $list[$order]['name'];
        $user_constructor->save();

    }
}
