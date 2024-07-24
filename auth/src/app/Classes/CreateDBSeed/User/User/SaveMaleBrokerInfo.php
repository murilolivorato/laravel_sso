<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 17:36
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use App\Models\UserBrokerInfo;

class SaveMaleBrokerInfo
{
    public function  handle(UserPub $user){

        $faker = \Faker\Factory::create();

        // USER BROKER
        $user->BrokerInfo()->save(
            factory(UserBrokerInfo::class)->make(['name' => $faker->firstName('male'), 'gender' => 'male'])
        );
    }
}
