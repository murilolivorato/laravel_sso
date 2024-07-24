<?php

namespace App\Classes\CreateDBSeed\DB;

class DBUserAdminArea
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        ['title'=>'supervisor area', 'url_title'=> 'supervisor',  'description'=>'supervisor area', 'url' => 'localhost:9000/login'] ,
        ['title'=>'worker area', 'url_title'=> 'worker', 'description'=>'worker area', 'url' => 'localhost:9001/login'] ,
    ];


    /**
     * @return \string[][]
     */
    public static function start_db() {
        return static::$start_db_data;
    }
}
