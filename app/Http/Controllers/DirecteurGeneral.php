<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirecteurGeneral extends Controller
{
    public function index(){
        return view('DG.index');
    }

    public function budgetsGlobaux()
    {
        // On affiche tous les budgets globaux qui ont été soumis au DG ou traités
        $budgetGlobals = \App\Models\BudgetGlobal::whereIn('statut', ['Soumis au DG', 'Approuvé', 'Modifications demandées'])->orderByDesc('created_at')->get();
        return view('DG.budgets-globaux', compact('budgetGlobals'));
    }

    public function showBudgetGlobal($id)
    {
        $budgetGlobal = \App\Models\BudgetGlobal::findOrFail($id);
        $budgets = \App\Models\Budget::where('budget_global_id', $id)->get();
        return view('DG.show-budget-global', compact('budgetGlobal', 'budgets'));
    }

    public function approuverBudgetGlobal($id)
    {
        $budgetGlobal = \App\Models\BudgetGlobal::findOrFail($id);
        if ($budgetGlobal->statut !== 'Approuvé') {
            $budgetGlobal->statut = 'Approuvé';
            $budgetGlobal->save();
            // Notification aux départements à faire ici (ex: event, mail, etc.)
        }
        return redirect()->route('DG.budgets-globaux')->with('success', 'Budget global approuvé avec succès.');
    }

    public function demanderModificationBudgetGlobal($id, Request $request)
    {
        $request->validate(['commentaire' => 'required|string']);
        $budgetGlobal = \App\Models\BudgetGlobal::findOrFail($id);
        $budgetGlobal->statut = 'Modifications demandées';
        $budgetGlobal->description = $budgetGlobal->description."\n[Demande DG] ".$request->commentaire;
        $budgetGlobal->save();
        // Notification aux départements à faire ici (ex: event, mail, etc.)
        return redirect()->route('DG.budgets-globaux')->with('success', 'Demande de modification envoyée.');
    }
}
