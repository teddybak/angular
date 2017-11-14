<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Provider extends Model
{
    protected $table = "providers";

    public static  function     getAllProviders(){
        $return_json ["retailers"] =    Provider::all();
        $return_json ["operation_status"]   = Config::get("constants.status.200");
        return $return_json;
    }
}
