<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    protected $fillable = [
        'num_ch','num_tel_ch','description_ch','nbr_lit_ch','nbr_pers','img_ch','status_ch','categorie_id','etage_ch'
    ];
    public function categorie(){
        return $this->belongsTo('App\Models\Categorie');
    }
}
