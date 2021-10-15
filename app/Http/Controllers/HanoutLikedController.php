<?php

namespace App\Http\Controllers;

use App\Models\hanoutLiked;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HanoutLikedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return DB::table('hanout_likeds')->select()->get();
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
     * @param  \App\Models\hanoutLiked  $hanoutLiked
     * @return \Illuminate\Http\Response
     */
    public function show(hanoutLiked $hanoutLiked)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hanoutLiked  $hanoutLiked
     * @return \Illuminate\Http\Response
     */
    public function edit(hanoutLiked $hanoutLiked)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hanoutLiked  $hanoutLiked
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hanoutLiked $hanoutLiked)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hanoutLiked  $hanoutLiked
     * @return \Illuminate\Http\Response
     */
    public function destroy(hanoutLiked $hanoutLiked)
    {
        //
    }

    public function getlikedHanout($idUser)
    {
      return DB::table('hanout_likeds')->where("idUser " , '=' , $idUser)->get();
    }

    public function addLike(Request $req)
    {
        $likeHanout = new hanoutLiked();
        $likeHanout->idHanout = $req->input('idHanout');
        $likeHanout->idUser = $req;

        $likeHanout->save();
        return "Liked";

    }
}
