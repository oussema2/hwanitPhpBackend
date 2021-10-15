<?php

namespace App\Http\Controllers;

use App\Models\Hanout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HanoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DB::table('hanouts')->get();
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
     * @param  \App\Models\Hanout  $hanout
     * @return \Illuminate\Http\Response
     */
    public function show(Hanout $hanout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hanout  $hanout
     * @return \Illuminate\Http\Response
     */
    public function edit(Hanout $hanout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hanout  $hanout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hanout $hanout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hanout  $hanout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hanout $hanout)
    {
        //
    }

    public function addHanout(Request $req)
    {
        $hanout = new Hanout();
        $unqId =   uniqid();
        $hanout->_id =  $unqId;
        $hanout->nom =  $req->input('nom');
        $hanout->adress =  $req->input('adress');
        $hanout->id_idOwner =  $req->input('id_idOwner');
        /* if($req->file('imageHAnout')){ */
            $hanout->imageHAnout = $req->file('imageHAnout')->store('hanoutImages',['disk' => 'public']);
        /* } */
        /* $hanout->imageHAnout =  $req->file('imageHAnout')->store('/ImageHanout/'); */

        $hanout->id_typehanouts =  $req->input('id_typehanouts');
       



        $hanout->save();
        return $hanout;

    }
    public function deleteHanout($id)
    {
       return Hanout::find($id)->delete();
    }
    public function getHanoutById($id)
    {
        return DB::table('hanouts')->where("id_idOwner" , "=" , $id)->get();
    }
}
