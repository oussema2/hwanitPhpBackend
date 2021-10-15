<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hanoutcommande extends Model
{
    use HasFactory;

    public function hanouts(){
        return $this->hasOne(Hanout::class);
    }

    public function commandes(){
        return $this->hasOne(Commande::class);
    }

}
