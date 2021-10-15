<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ImageProduitController;
use stdClass;

class ProduitController extends Controller
{
  
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
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
      
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        //
    }

    public function addProduit(Request $req)
    {
        $produit = new Produit();
    
        $produit->_id =$req->input('_id');
        $produit->nom =  $req->input('nom');
        $produit->description =  $req->input('description');
        $produit->prix = (float) $req->input('prix');
        $produit->id_categorie = (int)  $req->input('id_categorie');
        $produit->id_brand = (int)  $req->input('id_brand');
        $produit->quantitie = (int) $req->input('quantitie');
        $produit->id_hanout =  $req->input('id_hanout');
        $produit->thumbnail = $req->input('thumbnail');
        $produit->idInMongo = $req->input('idInMongo');
        $produit->save();
        
        return   $produit;

        /* //$produit->save();
        return $produit; 
      */
        
     
      
     


 
    }

    public function deleteProduit($id)
    {   
      
      $produit =  Produit::find($id);
      $resDelete =  $produit->delete();
        $res = Http::delete('http://localhost:8000/deleteImages/'.$id.'/'.$produit->idInMongo);
        return response([
           "responsePy" =>   $res,
            "deletedProduit" => $produit,
            "message" => "deleted",
            "status" => 200
        ]);
    }

    public function updateProduit(Request $req){
       
        $produit = Produit::find( $req->input('_id'));
        $produit->nom = $req->input('nom');
        
        $produit->description = $req->input('description');
        $produit->prix = $req->input('prix');
        $produit->id_categorie = $req->input('id_categorie');
        $produit->id_brand = $req->input('id_brand');
        $produit->quantitie = $req->input('quantitie');
        $produit->id_hanout = $req->input('id_hanout');
        $produit->idInMongo = $req->input('idInMongo');

        $produit->save();

        return $produit;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rowNum)
    {
        //
        $produitNumber = DB::select('SELECT count(*) as numbofProduit from `produits`');
         $dataProduit = DB::table('produits')->skip($rowNum)->take(10)->get();
    
            return  ProduitController::proccessData( $dataProduit ,$produitNumber[0] );
       
       
      
      

         
    }

    static function proccessData($dataProduit ,$produitNumber) {
      
       
        $produitDataRes = [];
        for ($i=0; $i < count($dataProduit); $i++) { 
            $controLlerPRod  = new ProduitController;
            $dataPRomo = $controLlerPRod->getProduitStauts($dataProduit[$i]->_id);
          
            $hanoutdata = $controLlerPRod->getImageHanout($dataProduit[$i]->id_hanout);
            $objProd = new stdClass;
            $promoObj = new stdClass;
            if ($dataPRomo) {
                $promoObj->inPromo = true;
                $promoObj->pourcentage =   $dataPRomo->promotionPourcentage;
            }else {
                $promoObj->inPromo = false;
            }
          
           
            $objProd->dataHanout =  $hanoutdata;
            $objProd->dataProduit = $dataProduit[$i];
            $objProd->dataPromo =   $promoObj ;
            array_push($produitDataRes ,  $objProd );
           
        }
       
        $resArr = [];
        array_push($resArr,  $produitNumber ) ;
        array_push($resArr,   $produitDataRes ) ;
        return   $resArr;
    }

      
    public function findProduit($id)
    {
       $produit = Produit::find($id);
       $promo = ProduitController::getProduitStauts($id);
     
        $objres =[];
        $objres[0] =  $produit;
        $promoX = new stdClass;
        if ($promo) {
            $promoX->inPromo = true;
            $promoX->pourcentage =   $promo->promotionPourcentage;
        }else {
            $promoX->inPromo = false;
        }
        $objres[1] =  $promoX;
        return $objres;
     
       
    }

    public function getWithBrand($idbrand ,$rowNum )
    {      
          $brId = DB::table('brands')->select('id')->where('brandName' , '=' ,$idbrand )->get();
          $produitNumber=  DB::select('SELECT count(*) as numbofProduit from `produits` WHERE id_brand = ' .$brId[0]->id );
          $dataProduit = DB::table('produits')->where('id_brand' , '=' ,$brId[0]->id )->skip($rowNum)->take(10)->get();
          return  ProduitController::proccessData( $dataProduit ,$produitNumber[0] );
        
       
      
      
    }
    public function getWithCategorie($categorie , $rowNum)
    {
        $catId = DB::table('categories')->select('id')->where('categorieName' , '=' ,$categorie )->get();
        $produitNumber =  DB::select('SELECT count(*) as numbofProduit from `produits` WHERE id_categorie  = ' .$catId[0]->id );
        $dataProduit = DB::table('produits')->where('id_categorie' , '=' ,$catId[0]->id )->skip($rowNum)->take(10)->get();
        return  ProduitController::proccessData( $dataProduit ,$produitNumber[0] );

      

     
    
    
    }
    public function getWithHanout($hanout , $rowNum)
    {
        $produitNumber =  DB::table('produits')->where('id_hanout' , '=' ,$hanout)->get()->count();
        $dataProduit = DB::table('produits')->where('id_hanout' , '=' ,$hanout )->skip($rowNum)->take(10)->get();
        $numProd = new stdClass;
        $numProd->numbofProduit =  $produitNumber;
        return  ProduitController::proccessData( $dataProduit ,  $numProd );


        
    }

    public function getWithHanoutAdmin($id)
    {
        return DB::table('produits')->where('id_hanout' , '=' ,$id)->get();
    }

    public function getWithHanoutCat($hanout , $categorie){
        return DB::table('produits')->where('id_hanout' , '=' ,$hanout )->where('id_categorie' , '=' , $categorie);
    }
  

    public function getProduitHome()
    {
        return  DB::table('produits')->take(8)->get();
       
      

    }

    public function getWithSearchName($target)
    {
       return DB::table('produits')->where('nom' , 'like' , '%'.$target.'%')->take(7)->get();
    }
    
 

    public function getonlyN($rowNum)
    {
        return DB::select("SELECT * from `produits` LIMIT $rowNum, 10");
    }


    public function getNUmberOFAllROws()
    {
        return DB::select("SELECT count(*) as RowNumber from `produits`");
    }

    private function getImageHanout($idHanout){
        return DB::table('hanouts')->select('imageHAnout' , 'nom')->where('_id' , '=' , $idHanout)->get()[0];
    }


    static  function getProduitStauts($id)
    {
        $produit = DB::table('promotion_produits')->where('id_Produit' , '=' , $id)->get();
        if (count($produit)>0) {
            $promoProd = new stdClass;
            $promotionData  = DB::table('promotions')->select('pourcentage')->where('id' , '=' , $produit[0]->id_Promotion)->get();
            $promoProd->promotionPourcentage =  $promotionData[0]->pourcentage;
            return  $promoProd;
        }else {
            return false;
        }
    }

    public function getWithSearch($target ,$rowNum)
    {
        $produitNumber =  DB::table('produits')->where('nom' , 'like' , '%'.$target.'%')->get()->count();
        $dataProduit = DB::table('produits')->where('nom' , 'like' , '%'.$target.'%')->skip($rowNum)->take(10)->get();
        $numProd = new stdClass;
        $numProd->numbofProduit =  $produitNumber;
        return  ProduitController::proccessData( $dataProduit ,  $numProd );
    }
  

    public function getPRoduitInProdDetail($id)
    {
       $produit = DB::table('produits')->where('id_categorie' , '=' , $id)->take(5)->get();
       $res = [];
       for ($i=0; $i <count($produit) ; $i++) { 
           $dataPromo = ProduitController::getProduitStauts($produit[$i]->_id);
           $data = new stdClass;
           $data->promoData =   $dataPromo;
           $data->produiDetail =$produit[$i];
           array_push($res ,   $data);
       }
       return $res;
    }
}
