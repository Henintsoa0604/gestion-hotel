<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestation_liste extends Model
{
    protected $fillable = [
        'designation','qte','prix_unique'
    ];
    public function chambre(){
        return $this->hasMany('App\Models\Prestation');
    }
}
