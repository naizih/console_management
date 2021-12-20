<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichiers extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id','nom_de_fichier', 'Chemin_de_fichier', 'resultat_de_check', 'date_du_dernier_check'
    ];
}
