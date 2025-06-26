<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\Budget;
use Illuminate\Http\Request;

class ResponsableFinance extends Controller
{
    public function index(){
        return view('RF.index');
    }

    public function consoliderbuget(){
        return view('RF.consolider-budget');
    }

    public function verifier_budget(){
        $budgets = Budget::all();
        return view('RF.verifier-budget', compact('budgets'));
    }

    // Route RF.consolider.ajax

    public function consoliderBudgets()
    {
        try {
            \App\Models\Budget::where('statut', 'soumis')
                ->update(['statut' => 'Consolidé et non soumis']);

            return response()->json([
                'success' => true,
                'message' => 'Budgets consolidés avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur : ' . $e->getMessage()
            ]);
        }
    }

    public function tableBudgets()
    {
        $budgets = \App\Models\Budget::all();
        return view('components.budget-table', compact('budgets'));
    }



}
