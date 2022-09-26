<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consommation extends Model
{
    protected $fillable = [
        'quantite_cons','montant_cons','user_id','reservation_id','produit_id'
    ];
    public function users(){
        return $this->belongsTo('App\User');
    }
    public function reservations(){
        return $this->belongsTo('App\Models\Reservation');
    }
    public function produits(){
        return $this->belongsTo('App\Models\Produit');
    }
}
