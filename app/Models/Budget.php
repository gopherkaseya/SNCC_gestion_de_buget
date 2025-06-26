<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'nom_departement',
        'description',
        'montant',
        'statut'
    ];
}
