<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Fichiers;

class Alerts extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'file_id'
    ];


    public function fichier()
    {
      return $this->belongsTo(Fichiers::class, 'file_id');
    }
    
}
