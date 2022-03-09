<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Clients;
use App\Models\ResultatCheck;
use App\Models\Alerts;


class Fichiers extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id','nom_de_fichier', 'Chemin_de_fichier', 'resultat_de_check', 'date_du_dernier_check'
    ];

    
    public function client(){
      return $this->belongsTo(Clients::class, 'client_id');
    }

    public function Resultat_check(){
      return $this->hasMany(ResultatCheck::class);
    }
  

    public function alert() {
      return $this->hasMany(Alerts::class);
    }


}
