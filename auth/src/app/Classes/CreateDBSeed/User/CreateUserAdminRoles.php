<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 13/01/2019
 * Time: 10:50
 */

namespace App\Classes\CreateDBSeed\User;

use App\Classes\CreateDBSeed\DB\DBUserAdminRole;
use App\Models\UserAdminRole;


class CreateUserAdminRoles
{
    public function  handle(){

        $user_admin_roler_fields = DBUserAdminRole::start_db();

        /*-------- USER ROLE */
        foreach($user_admin_roler_fields as $user_roler_field) {
            UserAdminRole::factory()->create($user_roler_field);
        }


    }

}
