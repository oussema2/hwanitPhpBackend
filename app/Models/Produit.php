<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $primaryKey = '_id' ;
    public $incrementing = false;


    public function hanout()
    {
      return $this->hasOne(Hanout::class);
    }

    public function brand()
    {
      return $this->hasOne(Brand::class);
    }
    public function categorie()
    {
      return $this->hasOne(Categorie::class);
    }

    public function typeImage() {
      return $this->hasMany(ImageProduit::class , '_id');
    }

}
