<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();
        return ['vendor' => $users];
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function register(Request $req)

    {
       $user = new User();
       $user->_id = uniqid();
       $user->nom = $req->input('nom');
       $user->prenom = $req->input('prenom');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password')) ;
       $user->numTel = $req->input('numTel');
       $user->type = $req->input('type');


        if(User::where('email' , '=' , $req->input('email'))->first()) {
           return "user Exist";
        }

       

       $user->save();
       return $user;

    }

    public function logIn(Request $request)
    {
      $val = Validator::make($request->all(),[
           'email'=>'required|email',
           'password' => 'required'
       ]);
       if($val->fails()){
           return response([
               'status'=>401,
               'message' => $val->errors()

           ]);
       }else {
        $user =  User::where('email' ,$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response([
                'status'=>401,
                'message' => 'Invalid Email OR Password'
 
            ]);
        }else{
            $token = $user->createToken($user->email.'_Token')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token,
                'status' => 200,
                'message' => 'logged in',
            ]);
        } 
    } 
 
    }

    public function deleteVendor($id)
    {
        User::where('_id' , $id)->delete();
        return 'deleted' ;
    }

    public function getTypeUser( $id)
    {
       return DB::table('users')->select('type')->where('_id' , '=' , $id)->get();
      
    }

}
