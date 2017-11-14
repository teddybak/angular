<?php

namespace App; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $table = "customers";

    public static function getAllCustomers()
    {
        return Customer::all();
    }


    public static function createNewCustomer(array $array)
    {
       DB::table('customers')->insert(
            array('customerName'            => $array["customerName"],
            'contactLastName'               => $array["contactLastName"],
            'contactFirstName'              => $array["contactFirstName"],
            'phone'                         => $array["phone"],
            'addressLine1'                  => $array["addressLine1"],
            'addressLine2'                  => $array["addressLine2"],
            'city'                          => $array["city"],
            'state'                         => $array["state"],
            'postalCode'                    => $array["postalCode"],
            'country'                       => $array["country"],
            'salesRepEmployeeNumber'        => $array["salesRepEmployeeNumber"],
            'creditLimit'                   => $array["creditLimit"]
            )
        );
         echo Config::get("constants.status.200");

    }


        public static function getCustomer($id){
           $result =   DB::table('customers')
            ->select('customers.*')
            ->where('customers.customerNumber',$id)
            ->get(); 

            if(!$result){
                $return_json ["operation_status"]   = Config::get("constants.status.404");
                return $return_json;
            }else{
                $return_json ["customer"] =  $result;
                $return_json ["operation_status"]   = Config::get("constants.status.200");
                return $return_json;
            }

        }


}