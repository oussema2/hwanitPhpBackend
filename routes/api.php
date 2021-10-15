<?php

use App\Models\Hanout;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HanoutController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TypeHanoutController;
use App\Http\Controllers\HanoutLikedController;
use App\Http\Controllers\HanoutcommandeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    if(Auth::check() ){
      return Auth::user();
    }else{
        return response([
            'message' => 'please login',
            'status' => 401

        ]);
    } 
});

Route::middleware(['auth:sanctum','Vendor' , 'superadmin'])->group((function(){
    Route::post('/addHanout' , [HanoutController::class , 'addHanout']);
    Route::delete('/deleteHanout/{id}' , [HanoutController::class , 'deleteHanout']);
    Route::delete('/deleteProduit/{id}' , [ProduitController::class , 'deleteProduit']);
    Route::post('/updateProduit' , [ProduitController::class , 'updateProduit']);
    Route::post('/addPromotion' , [PromotionController::class , 'addPromotion']);
    Route::get('/getCommandeHanout/{id}' , [HanoutcommandeController::class , 'getCommandeHanout']);
    Route::get('/getCommandeDetailHanout/{id}' , [HanoutcommandeController::class , 'getCommandeDetailHanout']);

})); 

Route::post('/addProduit' , [ProduitController::class , 'addProduit']);


Route::group(['middleware' => ['auth:sanctum', 'superadmin']], function() {
    Route::get('/getVendors' , [UserController::class , 'index']);
    Route::delete('/deleteVendor/{id}' , [UserController::class , 'deleteVendor']);

    Route::post('/addBrand' , [BrandController::class , 'addBrand']);
    Route::delete('/deleteBrand/{id}' , [BrandController::class , 'deleteBrand']);
    Route::post('/addCategorie' , [CategorieController::class , 'addCategorie']);
    Route::delete('/deleteCategorie/{id}' , [CategorieController::class , 'deleteCategorie']);
    Route::post('/addTypeHanout' , [TypeHanoutController::class , 'addTypeHanout']);
    Route::delete('/deleteTypeHanout/{id}' , [TypeHanoutController::class , 'deleteTypeHanout']);
});
Route::get('/checkpoint',function(){
    return response(['message'=>'api msaker']);
});
Route::post('/register' , [UserController::class , 'register']);
Route::post('/logIn' , [UserController::class , 'logIn'])->name('login');
Route::get('/getUserType/{id}' ,  [UserController::class , 'getTypeUser']);

Route::get('/findBrand/{id}' , [BrandController::class , 'findBrand']);
Route::get('/getBRandForHome' , [BrandController::class , 'getBRandForHome']);

Route::get('/getCategories' , [CategorieController::class , 'index']);

Route::get('/getTypeHanouts' , [TypeHanoutController::class , 'index']);

Route::get('/findCatrgorie/{id}' , [CategorieController::class , 'findCatrgorie']);
Route::get('/getBrands' , [BrandController::class , 'index']);

Route::get('/getAllPromotion' , [PromotionController::class , 'getAllPromotion']);
Route::get('/getHanouts' , [HanoutController::class , 'index']);


Route::get('/findTypeHanout/{id}' , [TypeHanoutController::class , 'findTypeHanout']);


Route::get('/getHanouts/{id}' , [HanoutController::class , 'getHanoutById']);



Route::get('/show' , [ProduitController::class , 'show']);
Route::get('/findProduit/{id}' , [ProduitController::class ,'findProduit' ]);
Route::get('/getAllProduits/{rowNum}' , [ProduitController::class , 'index']);
Route::get('/getWithBrand/{idbrand}/{rowNum}' , [ProduitController::class , 'getWithBrand']);
Route::get('/getWithCategorie/{categorie}/{rowNum}' , [ProduitController::class , 'getWithCategorie']);
Route::get('/getWithHanout/{hanout}/{rowNum}' , [ProduitController::class , 'getWithHanout']);
Route::get('/getWithSearch/{target}/{rowNum}' , [ProduitController::class , 'getWithSearch']);
Route::get('/getWithHanoutCat/{hanout}/{categorie}' , [ProduitController::class , 'getWithHanoutCat']);
Route::get('/getProduitHome' , [ProduitController::class , 'getProduitHome']);
Route::get('/getSearchProduit/{target}' , [ProduitController::class , 'getWithSearchName']);
Route::get('/getonlyN/{rowNum}' , [ProduitController::class , 'getonlyN']);
Route::get('/getNUmberOFAllROws' , [ProduitController::class , 'getNUmberOFAllROws']);
Route::get('/getWithHanout/{hanout}' , [ProduitController::class , 'getWithHanoutAdmin']);
Route::get('/getPRoduitInProdDetail/{id}' , [ProduitController::class , 'getPRoduitInProdDetail']);




Route::post('/addCommande' , [CommandeController::class , 'addCommande'])->middleware(['auth:sanctum']);
Route::post('/deliverd/{id}' , [CommandeController::class , 'delivred']);



Route::post('/addLike' , [HanoutLikedController::class , 'addLike']);
Route::get('/getlikedHanout/{idUser}' , [HanoutLikedController::class , 'getlikedHanout']);
Route::get('/getAllLikes' , [HanoutLikedController::class , 'index']);




Route::get('/getPromoOfHome' , [PromotionController::class , 'getPromoOfHome']);




Route::get('/getAllCommandesForTransporter' , [CommandeController::class , 'getAllCommandesForTransporter'])->middleware("auth:sanctum");
Route::get('/getCommandeDetailForTransporter/{id}' , [CommandeController::class , "getCommandeDetailForTransporter"]);