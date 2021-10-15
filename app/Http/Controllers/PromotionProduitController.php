<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\promotionProduit;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PromotionProduitController extends Controller
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
     * @param  \App\Models\promotionProduit  $promotionProduit
     * @return \Illuminate\Http\Response
     */
    public function show(promotionProduit $promotionProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promotionProduit  $promotionProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(promotionProduit $promotionProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\promotionProduit  $promotionProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, promotionProduit $promotionProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promotionProduit  $promotionProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(promotionProduit $promotionProduit)
    {
        //
    }

    static function addProduitCommande($idProduit , $idPromotion)
    {
        $promotionProduit = new promotionProduit();
        $promotionProduit->id_Produit = $idProduit;
        $promotionProduit->id_Promotion = $idPromotion;
        $promotionProduit->save();
    }

    static function FunctionName($idPromo)
    {
        
    }
}
