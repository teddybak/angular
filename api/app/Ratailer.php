<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Ratailer extends Model
{

    public $table = "retailers";

    public static  function     getAllRetailers(){
        $return_json ["retailers"] =    Ratailer::all();
        $return_json ["operation_status"]   = Config::get("constants.status.200");
        return $return_json;
    }

    public static function getAllRetailerId($id){
        $found = Ratailer::find($id);



        if(!$found){
            $return_json ["operation_status"]   = Config::get("constants.status.404");
            return $return_json;
        }else{
            $return_json ["retailer"] = Ratailer::find($id);
            $return_json ["operation_status"]   = Config::get("constants.status.200");
            return $return_json;
        }

    }


    public static function createNewRetailer(array $array){
        $affected = Ratailer::where('name', '=' ,$array["name"])->where('location', '=' ,$array["location"])->first();
        if($affected){
            $return_json ["operation_status"]   = Config::get("constants.status.409");
            return $return_json;
        }else{
            DB::table('retailers')->insert(
                array('name'	    =>	$array["name"],
                    'location'	    =>	$array["location"],
                    'email'	        =>	$array["email"],
                    'secret'        =>  $array["secret"])
            );
            return Config::get("constants.status.200");
        }
    }
}
