<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 07/03/2019
 * Time: 18:37
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserPub;
use App\Models\UserBrokerInfo;

class SaveFemaleBrokerInfo
{
    public function  handle(UserPub $user){

        $faker = \Faker\Factory::create();

        // USER BROKER
        $user->BrokerInfo()->save(
            factory(UserBrokerInfo::class)->make(['name' => $faker->name('female'), 'gender' => 'female'])
        );
    }
}
