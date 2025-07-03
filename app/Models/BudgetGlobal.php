<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetGlobal extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_total',
        'statut',
        'description',
    ];

    // Relation : un budget global a plusieurs budgets départementaux
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
}
