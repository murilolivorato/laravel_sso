<?php

namespace Database\Seeders;
use App\Classes\CreateDBSeed\CreateUser;
use App\Classes\CreateDBSeed\ResetData;
use App\Classes\CreateDBSeed\User\CreateUserAdmin;
use App\Classes\CreateDBSeed\User\CreateUserAdminRoles;
use App\Classes\CreateDBSeed\User\CreateUserArea;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            // USER ADMIN
            CreateUserAdminRoles::class ,
            CreateUserArea::class,
            CreateUserAdmin::class
        ];


        foreach ($tasks as $task){
            (new $task)->handle();
        }
    }
}
