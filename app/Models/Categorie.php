<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'code_cat','description_cat','prix_cat'
    ];
    public function chambre(){
        return $this->hasMany('App\Models\Chambre');
    }
}
