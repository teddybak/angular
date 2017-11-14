<?php

namespace App;

use App\Http\Requests\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "users";
    protected $fillable = ['firstName', 'lastName', 'email','password','rol_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getAllUsers(){
        $return_json ["users"] = User::all();
        $return_json ["operation_status"]   = Config::get("constants.status.200");
        return $return_json;
    }

    public static function getUser($id){

        $founded = User::find($id);

        if(!$founded){
            return Config::get("constants.status.404");
        }else {
            $return_json ["user"] = User::find($id);
            $return_json ["operation_status"]   = Config::get("constants.status.200");
            return $return_json;
        }


    }

    public static function createNewUser(array $array){

        $affected = User::where('firstName', '=' ,$array["firstName"])->where('lastName', '=' ,$array["lastName"])->first();
        if($affected){
            return "user alredy exist";
        }else{
            $password = bcrypt($array["password"]);
            DB::table('users')->insert(
                array('firstName'	=>	$array["firstName"],
                    'lastName'	    =>	$array["lastName"],
                    'email'	        =>	$array["email"],
                    'username'      =>  $array["username"],
                    'password'      =>  $password,
                    'role_id'       =>  $array["role_id"])
            );
            $return_json ["operation_status"]   = Config::get("constants.status.200");
            return  $return_json ["operation_status"];
        }

    }










}
