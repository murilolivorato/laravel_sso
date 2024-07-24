<?php

namespace App\Classes\Utilities;

class DBProviderStatus
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        /* 1 */ ['id' => 'active', 'title' => 'Ativo',   'url_title' => 'ativo'],
        /* 2 */ ['id' => 'no_active', 'title' => 'Bloqueado',  'url_title' => 'bloqueado'],
    ];

    /**
     * @return \string[][]
     */
    public static function getAll()
    {
        return static::$start_db_data;
    }
}
