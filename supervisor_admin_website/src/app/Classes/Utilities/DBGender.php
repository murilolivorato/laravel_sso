<?php

namespace App\Classes\Utilities;

class DBGender
{
    protected static $start_db_data = [

        /* 1 */ ['id' => 'male', 'title' => 'masculino', 'url_title' => 'masculino'],
        /* 2 */ ['id' => 'female', 'title' => 'feminino', 'url_title' => 'feminino'],

    ];

    public static function getAll()
    {
        return static::$start_db_data;
    }
}
