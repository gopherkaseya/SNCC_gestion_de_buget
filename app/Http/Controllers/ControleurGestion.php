<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControleurGestion extends Controller
{
    public function index()
    {
        return view('CG.index');
    }

    public function execution()
    {
        return view('CG.execution');
    }

    public function collecter()
    {
        // Affiche la vue de collecte des données d'exécution
        return view('CG.collecter');
    }

    public function storeExecution(Request $request)
    {
        $request->validate([
            'departement' => 'required|string',
            'montant_reel' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        \App\Models\ExecutionBudget::create($request->only(['departement', 'montant_reel', 'description']));
        return redirect()->route('CG.collecter')->with('success', 'Dépense enregistrée avec succès.');
    }
}
