<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    public $table = "roles";


    public static function getAllRoles(){
        $return_json ["roles"] = Role::all();
        $return_json ["operation_status"]   = Config::get("constants.status.200");
        return $return_json;
    }

    public static function getRoleID($id){

        $founded = Role::find($id);

            if(!$founded){
                $return_json ["operation_status"]   = Config::get("constants.status.404");
                return $return_json;
            }else{
                $return_json ["roles"] = $founded;
                $return_json ["operation_status"]   = Config::get("constants.status.200");
                return $return_json;
            }


    }


    public static function createNewRole(array $array){
        $affected = Role::where('name', '=' ,$array["name"])->first();
        if($affected){
            $return_json ["operation_status"]   = Config::get("constants.status.409");
            return $return_json;
        }else{

            DB::table('roles')->insert(
                array('name'	=>	$array["name"])
            );
            return Config::get("constants.status.200");
        }
    }

}
