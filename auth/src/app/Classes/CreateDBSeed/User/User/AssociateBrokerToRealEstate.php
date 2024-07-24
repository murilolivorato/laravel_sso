<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 17:46
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;

class AssociateBrokerToRealEstate
{
    public function  handle(UserPub $user){
        // ASSOCIATE THIS USER TO A REAL ESTATE , GET RANDON REAL ESTATE
        $user_real_estate_ids  = \DB::table('user_real_estate_infos')->select('user_id')->pluck('user_id')->toArray();

        $user->AssociatedRealEstate()->attach($user_real_estate_ids[array_rand($user_real_estate_ids)]);
    }
}
