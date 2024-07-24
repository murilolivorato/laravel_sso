<?php

namespace App\Classes\Utilities;

namespace App\Classes\Utilities;
use App\Classes\Helper\SetArrayValue;
class DBStatus extends DBUtility
{
    protected static $start_db_data = [
        /* 1 */ [ 'id' => 1 , 'title' => 'ativo'  , 'value' => "active" ,  'url_title' => 'ativo'  ] ,
        /* 2 */ [ 'id' => 2 , 'title' => 'inativo'  , 'value' => "no_active" , 'url_title' => 'inativo' ]
    ];

}
