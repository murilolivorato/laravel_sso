<?php


namespace App\Classes\CreateDBSeed\DB;


class DBUserAdminRole
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        ['title'=>'admin',  'label'=>'Adminer'] ,
        ['title'=>'worker',  'label'=>'Worker']
    ];


    /**
     * @return \string[][]
     */
    public static function start_db() {
        return static::$start_db_data;
    }
}
