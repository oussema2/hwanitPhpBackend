<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $primaryKey = '_id' ;
    public $incrementing = false;

  

    public function produit()
    {
       return $this->hasMany(Produit::class);
    }

    public function user()
    {
       return $this->hasOne(User::class);
    }
}
