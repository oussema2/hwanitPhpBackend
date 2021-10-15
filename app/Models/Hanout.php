<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hanout extends Model
{
    use HasFactory;
    protected $primaryKey = '_id' ;
    public $incrementing = false;

    public function typeHanout()
    {
       return $this->hasOne(TypeHanout::class);
       

    }

    public function ownerHanout()
    {
       return $this->hasOne(User::class);
    }

    public function commandes(){
       return $this->hasMany(Commande::class);
    }
}
