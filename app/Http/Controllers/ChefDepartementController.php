<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\Budget;
use Illuminate\Http\Request;

class ChefDepartementController extends Controller
{
    public function index(){
        return view('CD.index');
    }

    public function preparer(){
        $besoins = Besoin::all();
        return view('CD.preparer-budget', compact('besoins'));
    }

    public function store(Request $request)
    {
        Budget::create([
            'nom_departement' => $request->nom_departement,
            'description' => $request->description,
            'montant' => $request->montant,
            'statut' => 'soumis'
        ]);

        return to_route('chef-departement.preparer')->with('success', 'Le budget a été soumis avec succés');
    }
    public function analyse(){
        $besoins = Besoin::all();
        return view('CD.analyse', compact('besoins'));
    }
}
