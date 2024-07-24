<?php

namespace App\Classes\CreateDBSeed\User;

use App\Classes\CreateDBSeed\DB\DBUserAdminArea;
use App\Models\UserAdminAccessArea;

class CreateUserArea
{
    public function  handle(){
        $user_admin_area_fields = DBUserAdminArea::start_db();

        /*-------- USER ROLE */
        foreach($user_admin_area_fields as $user_roler_field) {
            UserAdminAccessArea::factory()->create($user_roler_field);
        }
    }
}
