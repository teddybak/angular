<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\User;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'user_id', 'retailer_id', 'status','total'
    ];

    public static function getAllOrders(){

        $orders = DB::table('orders')
        ->select( 'orders.*')
        ->get();
        $return_json ["orders"] =    $orders; //Order::all();
        $return_json ["operation_status"]   = Config::get("constants.status.200");
        return $return_json;
    }


  public static function getOrder($id){
     $result =   DB::table('orderdetails')
      ->select('orderdetails.*',DB::raw(' priceEach * quantityOrdered AS subtotal') )
      ->where('orderdetails.orderNumber',$id)
      ->get();

    $total = 0;

    foreach($result as $key => $value){
       foreach($value as $key2 => $value2){
            if( $key2 == 'subtotal' ) {
                $total += $value2;
            }
       }
    }




      if(!$result){
          $return_json ["operation_status"]   = Config::get("constants.status.404");
          return $return_json;
      }else{
          $return_json ["order"] =  $result;
          $return_json ["operation_status"]   = Config::get("constants.status.200");
          $return_json ["total"] = number_format($total,2);
          return $return_json;
      }

  }


    public static function getOrderCustomer($id)
    {

        $customer_total = 0;
        $orders_customer = \Illuminate\Support\Facades\DB::table('orders')
            ->join('retailers', 'retailers.id', '=', 'orders.retailer_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('retailers.*', 'customers.*', 'orders.*', 'retailers.email as retamail','orders.total as total')
            ->where('customers.id', $id)
            ->get();



        foreach($orders_customer as $key => $value){

            foreach ($value as $key2 => $value2){
                if($key2=='total'){
                    $customer_total += $value2;

                }
            }

        }


        $customer_detaill = array();
        foreach ($orders_customer as $key => $value) {
            foreach ($value as $key2 => $value2) {

                if ($key2 == 'firstname') {
                    //array_push($user_detaill, $value2);
                    array_push($customer_detaill,array('name' =>$value2));
                    continue;
                }

                if ($key2 == 'lastname') {
                    array_push($customer_detaill,array('lastname' => $value2));
                    continue;
                }

                if (count($customer_detaill) > 1) {
                    break;
                }
            }

        }

        $return_json ["orders_customer"] = $orders_customer;
        $return_json ["total_customer"] = $customer_total;
        $return_json ["customer_detaill"] = $customer_detaill;
        $return_json ["operation_status"] = Config::get("constants.status.200");
        return $return_json;
    }



 













    public static function getOrderId($id){
        $return_json ["result"] =   DB::table('orders')->join('retailers', 'retailers.id', '=', 'orders.retailer_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('retailers.*', 'customers.*', 'orders.*')
            ->where('orders.id',$id)
            ->get();

 

        if(!$return_json){
            $return_json ["operation_status"]   = Config::get("constants.status.404");
            return $return_json ["operation_status"];
        }else{
            $return_json ["operation_status"]   = Config::get("constants.status.200");
            return $return_json;
        }
    }

    public static function createNewOrder(array $array){
        //$affected = Order::where('firstName', '=' ,$array["firstName"])->where('lastName', '=' ,$array["lastName"])->first();

        if(!Customer::find($array["customer_id"]) || !Ratailer::find($array["retailer_id"])) {
            $return_json ["operation_status"]   = Config::get("constants.status.404");
            return $return_json;
        }else{

            DB::table('orders')->insert(
                array('customer_id'	        =>	$array["customer_id"],
                    'retailer_id'	        =>	$array["retailer_id"],
                    'status'	            =>	$array["status"],
                    'total'                 =>  $array["total"])
            );
            return Config::get("constants.status.200");
        }
    }



    public static function getUserOrders($id){
        if(!User::find($id)) {
            $return_json ["operation_status"]   = Config::get("constants.status.404");
            return $return_json;
        }else{
            $return_json ["order"] = Order::where('user_id', '=' ,$id)->get();
            $return_json ["operation_status"]   = Config::get("constants.status.200");
            return $return_json;

        }
    }


    public static function getOrdersStatus($status){
        return Order::where('status', 'like' ,$status)->get();
    }


    public static function updateOrder(array $array, $id){
//        DB::table('orders')->where('id','=', $id)->update($array);
//        $return_json ["operation_status"]   = Config::get("constants.status.200");
//        return $return_json;
    }


}
