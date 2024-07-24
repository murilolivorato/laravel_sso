<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 17:02
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use App\Models\UserRealEstateInfo;
use App\Classes\CreateDBSeed\DB\DBUserRealEstateProfiles;

class ChangeRealEstateUserName
{
    public function  handle(UserPub $user){

        $list = DBUserRealEstateProfiles::all();
        $order = $user->RealEstateInfo->id - 1;

        $user_real_estate = UserRealEstateInfo::find($user->RealEstateInfo->id);
        $user_real_estate->company_name = $list[$order]['name'];
        $user_real_estate->save();

    }
}
