<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_entreprise', 'nom_client', 'mobile', 'email', 'site'
    ];
}
