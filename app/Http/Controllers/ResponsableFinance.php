<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\Budget;
use Illuminate\Http\Request;

class ResponsableFinance extends Controller
{
    public function index(){
        $budgets =  Budget::all();
        return view('RF.index', compact('budgets'));
    }

    public function consoliderbuget(){
        return view('RF.consolider-budget');
    }

    public function verifier_budget(){
        $budgets = Budget::where('statut','soumis')->
            orWhere('statut','consolidé et non soumis')
            ->get();
        return view('RF.verifier-budget', compact('budgets'));
    }

    // Route RF.consolider.ajax

    public function consoliderBudgets()
    {
        try {
            // Récupérer les budgets à consolider
            $budgets = \App\Models\Budget::where('statut', 'soumis')->get();

            // Calculer le montant total
            $montantTotal = $budgets->sum('montant');

            // Création d'un nouveau BudgetGlobal avec le montant total
            $budgetGlobal = new \App\Models\BudgetGlobal();
            $budgetGlobal->montant_total = $montantTotal;
            $budgetGlobal->statut = 'Consolidé';
            $budgetGlobal->description = 'Consolidation du ' . now()->format('Y-m-d H:i:s');
            $budgetGlobal->save();

            foreach ($budgets as $budget) {
                $budget->statut = 'Consolidé et non soumis';
                $budget->budget_global_id = $budgetGlobal->id;
                $budget->save();
            }

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

    public function soumettreBudgetsAuDG()
    {
        try {
            \App\Models\Budget::where('statut', 'Consolidé et non soumis')
                ->update(['statut' => 'Soumis au DG']);

            return response()->json([
                'success' => true,
                'message' => 'Budgets soumis avec succès au DG.'
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

    public function budgetsGlobalsNonSoumis()
    {
        $budgetGlobals = \App\Models\BudgetGlobal::all(); // Afficher tous les budgets globaux
        return view('RF.budget-globals-non-soumis', compact('budgetGlobals'));
    }

    public function soumettreBudgetGlobal($id)
    {
        $budgetGlobal = \App\Models\BudgetGlobal::findOrFail($id);
        if ($budgetGlobal->statut !== 'Soumis au DG') {
            $budgetGlobal->statut = 'Soumis au DG';
            $budgetGlobal->save();
            \App\Models\Budget::where('budget_global_id', $budgetGlobal->id)
                ->update(['statut' => 'Soumis au DG']);
        }
        return redirect()->route('RF.budgets-globaux-non-soumis')->with('success', 'Budget global soumis au DG avec succès.');
    }

}
