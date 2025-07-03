<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\Budget;
use Illuminate\Http\Request;

class ChefDepartementController extends Controller
{
    public function index(){
        $besoins = Besoin::orderBy('created_at', 'desc')->get();
        return view('CD.index', compact('besoins'));
    }

    public function preparer(){
        $besoins = Besoin::all();
        return view('CD.preparer-budget', compact('besoins'));
    }

    public function store(Request $request)
    {
        $budget = Budget::create([
            'nom_departement' => $request->nom_departement,
            'description' => $request->description,
            'montant' => $request->montant,
            'statut' => 'soumis',
            // On ne précise pas budget_global_id, il sera NULL par défaut
        ]);

        if ($request->has('besoin_ids')) {
            Besoin::whereIn('id', $request->besoin_ids)->update([
                'budget_id' => $budget->id
            ]);
        }

        return to_route('chef-departement.preparer')->with('success', 'Le budget a été soumis avec succés');
    }
    public function analyse(){
        $besoins = Besoin::all();
        return view('CD.analyse', compact('besoins'));
    }
}
