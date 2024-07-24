<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 09/03/2019
 * Time: 21:06
 */

namespace App\Classes\CreateDBSeed\User\User;

use App\Models\UserPub;
use App\Models\UserPresentationPhone;

class SavePresentationPhone
{
    public function  handle(UserPub $user){
        $whats_app_values = ['comercial', 'mobile' , 'whats_app'];

        // 10 images per gallery
        foreach (range(1, 3) as $i) {
            $user->Presentation->Phone()->save(
                factory(UserPresentationPhone::class)->make(['type' => $whats_app_values[array_rand($whats_app_values)] ])
            );
        }
    }
}
