<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 13/01/2019
 * Time: 10:51
 */

namespace App\Classes\CreateDBSeed\User;
use App\Models\UserAdmin;

use App\Models\UserAdminInfo;
use File;
use App\Classes\CreateDBSeed\User\User\CreateUserImage;

class CreateUserAdmin
{

    public function  handle(){
        $faker = \Faker\Factory::create();
        $user_admin_access_areas_ids  = \DB::table('user_admin_access_areas')->select('id')->pluck('id')->toArray();
        $this->createMaleAdmin($faker, $user_admin_access_areas_ids);
        $this->createFemaleAdmin($faker, $user_admin_access_areas_ids);

    }

    public function createMaleAdmin ($faker, $user_admin_access_areas_ids) {
        /*-----   USER ADMIN */
        UserAdmin::factory()->count(20)->create()->each(function($user) use ($faker, $user_admin_access_areas_ids)   {

            // SYNC ROLE
            $user->roles()->sync(
                [0 => 1 ]
            );
            // SYNC USER AREAS
            $userAreas = self::getRandomAcessArea($user_admin_access_areas_ids);
            $user->AcessAreas()->sync(
                $userAreas
            );
            // CREATE USER INFO
            UserAdminInfo::factory()->create(['name'           => $faker->firstName('male'),
                'user_id'        => $user->id]);
        });
    }

    public function createFemaleAdmin ($faker, $user_admin_access_areas_ids) {
        /*-----   USER ADMIN */
        UserAdmin::factory()->count(20)->create()->each(function($user)  use ($faker, $user_admin_access_areas_ids)  {
            $userAdmin = UserAdmin::find($user->id);
            // SYNC AREA
            $user->roles()->sync(
                [0 => 1 ]
            );
            // SYNC USER AREAS
            $userAreas = self::getRandomAcessArea($user_admin_access_areas_ids);
            $user->AcessAreas()->sync(
                $userAreas
            );
            // CREATE USER INFO
            UserAdminInfo::factory()->create(['name'           => $faker->firstName('female'),
                'user_id'        => $user->id]);
        });
    }

    protected static function getRandomAcessArea ($user_admin_access_areas_ids) {
        $a = range(1,count($user_admin_access_areas_ids));

        shuffle($a);

        return array_slice($a, 0, 2);
    }
}
