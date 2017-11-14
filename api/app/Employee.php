<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
   public $table = "employees";


  public static function getAllEmployees(){
    $return_json ["employees"] = Employee::all();
    $return_json ["operation_status"]   = Config::get("constants.status.200");
    return $return_json;
  }

  public static function getEmployee($id){
     $result =   DB::table('employees')
      ->select('employees.*')
      ->where('employees.employeeNumber',$id)
      ->get();

      if(!$result){
          $return_json ["operation_status"]   = Config::get("constants.status.404");
          return $return_json;
      }else{
          $return_json ["employee"] =  $result;
          $return_json ["operation_status"]   = Config::get("constants.status.200");
          return $return_json;
      }

  }

      public static function createNewEmployee(array $array)
      {
         DB::table('employees')->insert(
              array('lastName'            => $array["lastName"],
              'firstName'               => $array["firstName"],
              'extension'              => $array["extension"],
              'email'                         => $array["email"],
              'officeCode'                  => $array["officeCode"],
              'reportsTo'                  => $array["reportsTo"],
              'jobTitle'                          => $array["jobTitle"]
              )
          );
           echo Config::get("constants.status.200");

      }

}
