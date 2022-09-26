<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'designation','qte','prix_unique'
    ];
    public function chambre(){
        return $this->hasMany('App\Models\Consommation');
    }
}
