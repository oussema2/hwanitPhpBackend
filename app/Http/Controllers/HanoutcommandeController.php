<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use stdClass;
use App\Models\Hanout;
use Illuminate\Http\Request;
use App\Models\hanoutcommande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HanoutcommandeController extends Controller
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
     * @param  \App\Models\hanoutcommande  $hanoutcommande
     * @return \Illuminate\Http\Response
     */
    public function show(hanoutcommande $hanoutcommande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hanoutcommande  $hanoutcommande
     * @return \Illuminate\Http\Response
     */
    public function edit(hanoutcommande $hanoutcommande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hanoutcommande  $hanoutcommande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hanoutcommande $hanoutcommande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hanoutcommande  $hanoutcommande
     * @return \Illuminate\Http\Response
     */
    public function destroy(hanoutcommande $hanoutcommande)
    {
        //
    }

    static function addHanoutCommande(String $code , $produitCommandea)
    {
     
        $filtredArray = [];
        for ($i=0; $i < count($produitCommandea); $i++) { 
            $obj2 = json_encode( $produitCommandea[$i], true );
            $encodedRes = json_decode($obj2);
            if ( array_key_exists($encodedRes->id_hanout , $filtredArray) == 1) {

                $filtredArray[$encodedRes->id_hanout]['nombreProduit'] = $filtredArray[ $encodedRes->id_hanout]['nombreProduit'] +1 ;
            }else {
                $filtredArray[$encodedRes->id_hanout]['nombreProduit'] = 1 ;

            }
        }
        
        foreach ($filtredArray as $key => $value) {
            $hanoutCommande  = new hanoutcommande();
            $hanoutCommande->idHanout = $key;
            $hanoutCommande->idCommande = $code;
            $hanoutCommande->nombreProduit = $value['nombreProduit'];
            $hanoutCommande->delivred = false;
            $hanoutCommande->save();



        }

      

      
        return "all added"; 
      
    }


    public function getCommandeHanout($id)
    {
       $commandeHanout = DB::table('hanoutcommandes')->where('idHanout' , '=' , $id)->get();
        $res = [];
       for ($i=0; $i <count($commandeHanout) ; $i++) { 
          $objsss = new stdClass;
          $date = DB::table('commandes')->where('_id' , '=' ,$commandeHanout[$i]->idCommande )->select('dateCommande')->get();
          $produitCommande = DB::table('commande_produits')->where('id_commande' ,'=' , $commandeHanout[$i]->idCommande )->where('id_hanout' , '=' ,$id )->get();
          $total = 0;
          for ($i=0; $i <count( $produitCommande) ; $i++) { 
            $total = $total + DB::table('produits')->select('prix')->where('_id' , '=' ,$produitCommande[$i]->id_produit )->get()[0]->prix * $produitCommande[$i]->quantitie;
           
          } 
          $objsss->total =   $total;
         
            $objsss->dateCommande =   $date[0]->dateCommande;
          
            $objsss->commandeHanoutdetail = $commandeHanout;
         
         
          array_push($res ,   $objsss );
        
       }
        return $res;




    }


    public function getCommandeDetailHanout($id)
    {
       $commandeHanout = Db::table('hanoutcommandes')->where('idCommande' , $id)->get()[0];
       $detailommande =  DB::table('commandes')->where('_id' , '=' ,$commandeHanout->idCommande )->get()[0];
       $hanoutDetail = DB::table('hanouts')->where('_id' , '=' ,$commandeHanout->idHanout )->get()[0];
       $dataProduit =  DB::table('commande_produits')->where('id_hanout' , '=' ,  $commandeHanout->idHanout)->where('id_commande' , '=' ,$commandeHanout->idCommande)->get();
       $userData = User::find( $detailommande->id_user);
       $detailommande->userData =  $userData;
    $total = 0;
       for ($i=0; $i <count($dataProduit) ; $i++) { 
           $dataProduit[$i]->detailProduit = Produit::find($dataProduit[$i]->id_produit);
           $total = $total + $dataProduit[$i]->detailProduit->prix;
        }
       return  response([
           "status" => 200,
           "commandeHanout" => $commandeHanout,
           "detailCommande" =>    $detailommande,
           "hanoutDetail" => $hanoutDetail,
           "produitCommande" =>   $dataProduit,
           "totalFacture" =>  $total
       ]) ;
    }
}
