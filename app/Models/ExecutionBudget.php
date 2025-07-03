<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutionBudget extends Model
{
    use HasFactory;
    protected $fillable = [
        'departement',
        'montant_reel',
        'description',
    ];
}

