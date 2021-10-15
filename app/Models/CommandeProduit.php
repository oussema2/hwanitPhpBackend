<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeProduit extends Model
{
    use HasFactory;

    public function CommandeProduit()
    {
        return $this->hasOne(Produit::class);
    }

    public function CommandeHanout()
    {
      return $this->hasOne(Hanout::class);
    }
}
