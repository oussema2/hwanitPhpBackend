<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Carbon\Carbon;
use App\Models\promotion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use stdClass;

class PromotionController extends Controller
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
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(promotion $promotion)
    {
        //
    }

    public function addPromotion(Request $req)
    {
        $promo = new promotion();
      
        $promo->date_Debut =Carbon::parse($req->input('date_Debut'))->format('Y/m/d');
        $promo->date_Fin =Carbon::parse($req->input('date_Fin'))->format('Y/m/d');
        $promo->namePromo = $req->input('namePromo');
        $promo->id_hanout =$req->input('id_hanout') ;
        $promo->pourcentage = $req->input('pourcentage');
     
   
        $products =  $req->input('products');
        $promo->save();
        $idPromo = $promo->id;
        for ($i=0; $i <count($products) ; $i++) { 
            PromotionProduitController::addProduitCommande($products[$i],$idPromo );
        }
 
return    "added";

    }

    public function getAllPromotion()
    {
        $res=[];
        $promoTions = promotion::all();
       $tableProduit=[];
        for ($i=0; $i <count($promoTions) ; $i++) { 
            $obj = new stdClass;
            $id= $promoTions[$i]['id'];
           
        $produitInThisPromo = DB::table('promotion_produits')->where('id_Promotion' , '=' ,$id)->get();
        
        
      $prod = [];
            for ($j=0; $j <count($produitInThisPromo)  ; $j++) { 
            $produitInPromoData = DB::table('produits')->where('_id' , '=' ,$produitInThisPromo[$j]->id_Produit)->get();
            array_push($prod , $produitInPromoData[0]  );
            }
            $obj->idPromo = $promoTions[$i]['id'];
            $obj->pourcentage = $promoTions[$i]['pourcentage'];
          
            $obj->dateDebut = $promoTions[$i]['date_Debut'];
            $obj->dateFin = $promoTions[$i]['date_Fin'];
            $obj->nomPromo = $promoTions[$i]['namePromo'];
            $obj->produit = $prod;
            array_push($res , $obj);
 
 
 
        } 

        return $res;
    }

    public function getPromoOfHome()
    {
    $produit = DB::table('promotion_produits')->take(10)->get();
   
    $res = [];
    for ($i=0; $i <count($produit) ; $i++) { 
            $obj = new stdClass;
            $promoPourcentage = DB::table('promotions')->select('pourcentage')->where('id' , $produit[$i]->id_Promotion)->get();
            $produitData = Produit::find($produit[$i]->id_Produit);
            $obj->pourcentage = $promoPourcentage[0]->pourcentage;
            $obj->produit = $produitData;
            array_push($res , $obj);
    
        }   
        return $res;

    }
}
