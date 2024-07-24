<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 09/03/2019
 * Time: 10:06
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use App\Models\UserCompanyOwProfile;

class SaveCompanyOwProfile
{
    public function  handle(UserPub $user){
        $user->CompanyOwProfile()->save(
            factory(UserCompanyOwProfile::class)->make()
        );
    }
}
