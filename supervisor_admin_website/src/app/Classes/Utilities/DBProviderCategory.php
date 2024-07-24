<?php

namespace App\Classes\Utilities;

class DBProviderCategory
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        /* 1 */ ['id' => 1, 'title' => 'Pessoa Física',   'url_title' => 'pessoa-fisica'],
        /* 2 */ ['id' => 2, 'title' => 'Pessoa Jurídica',  'url_title' => 'pessoa-jurídica'],
    ];

    /**
     * @return \string[][]
     */
    public static function getAll()
    {
        return static::$start_db_data;
    }
}
