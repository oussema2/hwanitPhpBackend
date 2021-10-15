<?php

namespace App\Http\Controllers;

use App\Models\ImageProduit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ImageProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\ImageProduit  $imageProduit
     * @return \Illuminate\Http\Response
     */
    public function show(ImageProduit $imageProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageProduit  $imageProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageProduit $imageProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageProduit  $imageProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageProduit $imageProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageProduit  $imageProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageProduit $imageProduit)
    {
        //
    }

    static function addImageProduit(String $idProduit , String $nameImage)
    {
        $imageProduit  = new ImageProduit();
        $imageProduit->idProduit = $idProduit ; 
        $imageProduit->imageProduit = $nameImage;

        $imageProduit->save();
        return "added" ;
    }
}
