<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::getAllOrders();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Order::createNewOrder($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::getOrder($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = Order::find($id);
        if(!$result){
            $return_json ["operation_status"]   = Config::get("constants.status.404");
            return $return_json;
        }else{
            $return_json ["orders"] = Order::where('id', '=', "$id")
                ->update(array(
                    'retailer_id' =>  $request["retailer_id"],
                    'status' =>  $request["status"],
                    'total' =>  $request["total"],
                ));
            $return_json ["operation_status"]   = Config::get("constants.status.200");
            return  $return_json ["operation_status"];
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getOrderCustomer($id){
        return Order::getOrderCustomer($id);

    }
 


    public function getOrdersStatus($status){
        return Order::getOrdersStatus($status);
    }


    public function get_enum_values()
    {



    $status = DB::table('orders')->select(DB::raw("SELECT SUBSTRING(COLUMN_TYPE,5) FROM
                    information_schema.COLUMNS WHERE TABLE_SCHEMA='easyoddsbd' 
                    AND TABLE_NAME='orders' AND COLUMN_NAME='status'"))->get();

return json_encode($status);



    }


}
