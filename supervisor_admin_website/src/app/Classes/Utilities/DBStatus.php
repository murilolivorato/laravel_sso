<?php

namespace App\Classes\Utilities;

class DBStatus
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        /* 1 */ ['id' => 'active', 'title' => 'ativo',   'url_title' => 'ativo'],
        /* 2 */ ['id' => 'no_active', 'title' => 'não ativo',  'url_title' => 'nao-ativo'],
    ];

    /**
     * @return \string[][]
     */
    public static function getAll()
    {
        return static::$start_db_data;
    }
}
