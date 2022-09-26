<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date_debut','date_fin','date_paye','nbr_jour','montant','status','desc','chambre_id','user_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function chambre(){
        return $this->belongsTo('App\Models\Chambre');
    }
    public function prestation(){
        return $this->belongsTo('App\Models\Prestation');
    }
}
