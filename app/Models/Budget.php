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

    public function besoins()
    {
        return $this->hasMany(Besoin::class);
    }
    public function budgetGlobal()
    {
        return $this->belongsTo(BudgetGlobal::class);
    }
}
