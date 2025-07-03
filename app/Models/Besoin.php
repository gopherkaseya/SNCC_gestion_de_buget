<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
    protected $fillable = [
        'nom_service',
        'description',
        'montant',
        'statut',
        'budget_id',
    ];

    public function budget(){
        return $this->belongsTo(Budget::class);
    }
}
