<?php

namespace App\Models;


use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory;
  protected $primaryKey = '_id';
    public $incrementing = false;
    use HasFactory,HasApiTokens;


    public function produitLiked()
    {
      return $this->hasMany(produitLiked::class);
    }
    public function hanoutLiked()
    {
      return $this->hasMany(hanoutLiked::class);
    }

    public function checktype(){
      return $this->type;
    }
}
