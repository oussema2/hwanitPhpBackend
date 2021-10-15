<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Hanout;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
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
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        //
    }

    public function addCommande(Request $req)
    {
     
        $commande = new Commande();
        $code = uniqid();
        $commande->_id = $code;
        $commande->numTelDestinataire = $req->input('numTelDestinataire');
        $commande->addressDestinataire = $req->input('addressDestinataire');
        $commande->productNumber = $req->input('productNumber');
        $commande->dateCommande = $req->input('dateCommande');
        $commande->total = $req->input('total');
        $commande->id_user = auth()->user()->_id;

        $commande->delivredTransporteur = false;


        $produitCommande = $req->input('produits');
        $commande->save();

     

       
       
        for ($i=0; $i <count($produitCommande) ; $i++) { 
            CommandeProduitController::addProduitCommande($code , $produitCommande[$i]);
        }
      $resHanoutCommande =  HanoutcommandeController::addHanoutCommande($code, $produitCommande);


         return $commande;

    }


    public function delivred($id)
    {
        $commande = Commande::find($id);
        $commande->delivred = true ;
        $commande->save();
        return $commande;


    }

    public function getAllCommandesForTransporter()
    {
        $res = Commande::all();
        return response([
            "status" => 200,
            "data" => $res
        ]);
    }

    public function getCommandeDetailForTransporter($id)
    {
      
        $commande =  Commande::find($id);
        $produitCommande = DB::table('commande_produits')->where("id_commande" , $commande->_id)->get();
        $total = 0;
         for ($i=0; $i <count($produitCommande) ; $i++) { 
            $produitCommande[$i]->detailProduit = Produit::find($produitCommande[$i]->id_produit);
            $produitCommande[$i]->hanoutData = Hanout::find($produitCommande[$i]->id_hanout);
            $total =   $total +   $produitCommande[$i]->detailProduit->prix;
        } 

        $userData = User::find($commande->id_user);

    
        return response([
            "status"=> 200,
            "dataCommande" => $commande,
            "produitCommande" => $produitCommande,
            "userData" => $userData,
            "totalFacture" =>  $total
          
        ]);
    }
}
