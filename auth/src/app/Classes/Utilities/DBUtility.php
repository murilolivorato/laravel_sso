<?php

namespace App\Classes\Utilities;
use App\Classes\Helper\SetArrayValue;
class DBUtility
{
    public static function all() {
        return static::$start_db_data;
    }

    // GET VALUE BY ID
    public static function getValue($id, $name_input =  "value", $name_id = "id"){
        // IF IS NULL
        if($id == null){
            return [];
        }
        foreach (static::$start_db_data as $item){
            if($id == $item[$name_id]){
                return $item[$name_input];
            }
        }
    }


    public static function listValueURL($selected_list ,$name_input ) {
        $selected_list = SetArrayValue::addArrayElement($selected_list);

        $list =[];
        foreach (static::$start_db_data as $obj) {

            if(in_array( $obj['id'] , $selected_list) ) {
                array_push($list, $obj[$name_input]);
            }
        }

        return $list;
    }
}
