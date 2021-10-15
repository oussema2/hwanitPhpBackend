<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = DB::table('vendors')->get();
        return ['vendor' => $vendors];
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
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

    public function register(Request $req)

    {
       $vendor = new Vendor();
       $vendor->_id = uniqid();
       $vendor->nom = $req->input('nom');
       $vendor->prenom = $req->input('prenom');
        $vendor->email = $req->input('email');
        $vendor->password = Hash::make($req->input('password')) ;
       $vendor->numTel = $req->input('numTel');

       $vendor->imageVendor = $req->input('imageVendor');

       

       $vendor->save();
       return $vendor;

    }

    public function logIn($email , $password)
    {
       $vendor =  Vendor::where('email' , '=' , $email)->first();
       

        if (Hash::check($password, $vendor->password) == 1) {
           return   $vendor;
        }
        return null ;
      
      
    }

    public function deleteVendor($id)
    {
        Vendor::where('_id' , $id)->delete();
        return 'deleted' ;
    }

  

   
}
