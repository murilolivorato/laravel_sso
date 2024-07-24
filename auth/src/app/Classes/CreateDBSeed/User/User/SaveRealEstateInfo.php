<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 16:52
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use App\Models\UserRealEstateInfo;

class SaveRealEstateInfo
{
    public function  handle(UserPub $user){
        // REAL ESTATE
        $user->RealEstateInfo()->save(
            factory(UserRealEstateInfo::class)->make()
        );
    }
}
