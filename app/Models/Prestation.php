<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $fillable = [
        'designation_pres','prix_pres','montant_pres','user_id','reservation_id'
    ];
    public function users(){
        return $this->belongsTo('App\User');
    }
    public function reservations(){
        return $this->belongsTo('App\Models\Reservation');
    }
}
