<?php

namespace App\Classes\Utilities;

class DBProviderClassification
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        /* 1 */ ['id' => 'customer', 'title' => 'cliente',   'url_title' => 'cliente'],
        /* 2 */ ['id' => 'provider', 'title' => 'fornecedor',  'url_title' => 'fornecedor'],
        /* 2 */ ['id' => 'both', 'title' => 'ambos',  'url_title' => 'ambos'],
    ];

    /**
     * @return \string[][]
     */
    public static function getAll()
    {
        return static::$start_db_data;
    }
}
