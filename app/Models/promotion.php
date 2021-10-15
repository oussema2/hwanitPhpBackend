<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;

 public function produit()
    {
      return $this->hasMany(Produit::class);
    }

    public function hanout()
    {
      return $this->hasOne(Hanout::class);
    }
}
