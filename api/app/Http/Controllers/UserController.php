<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{


public function __construct()
{
    $this->middleware('cors');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return User::getAllUsers();
    }

    public function prueba (Request $request){
        return"hola amigos";
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
       echo  User::createNewUser($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::getUser($id);
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
        $result = User::find($id);
        if(!$result){
            return "User not found";
        }else{
            $password = bcrypt($request["password"]);
            $return_json ["users"] = User::where('id', '=', "$id")
                ->update(array(
                    'firstName' =>  $request["firstName"],
                    'lastName'  =>  $request["lastName"],
                    'email'     =>  $request["email"],
                    'password'  =>  $password,
                    'role_id'   =>  $request["role_id"])
                );
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
}
