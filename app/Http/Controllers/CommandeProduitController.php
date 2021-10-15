<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\CommandeProduit;
use App\Models\Produit;
use Illuminate\Console\Command;
use Illuminate\Routing\Controller;

class CommandeProduitController extends Controller
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
     * @param  \App\Models\CommandeProduit  $commandeProduit
     * @return \Illuminate\Http\Response
     */
    public function show(CommandeProduit $commandeProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommandeProduit  $commandeProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(CommandeProduit $commandeProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommandeProduit  $commandeProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommandeProduit $commandeProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommandeProduit  $commandeProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommandeProduit $commandeProduit)
    {
        //
    }

    static function addProduitCommande(String $code , $produitCommandea)
    {   

        $produitCommande  = new CommandeProduit();
        $produitCommande->id_commande = $code ; 


        $obj2 = json_encode( $produitCommandea, true );
        $encodedRes = json_decode($obj2);
     
        $produitCommande->id_hanout = $encodedRes->id_hanout ; 

        $produitCommande->id_produit = $encodedRes->id_produit ; 
     /*   $produit = Produit::find($encodedRes->id_produit);
        $produit->quantitie =   $produit->quantitie - $encodedRes->quantitie;
        $produit->save(); 
 */
        $produitCommande->quantitie = $encodedRes->quantitie;

        $produitCommande->save();
        return $produitCommande; 
      
    }

    public function getCommandes()
    {
        # code...
    }

    
}
