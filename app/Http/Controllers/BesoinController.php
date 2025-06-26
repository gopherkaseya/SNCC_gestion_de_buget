<?php

namespace App\Http\Controllers;

use App\Models\besoin;
use Illuminate\Http\Request;

class BesoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CD.soumission-besoin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Besoin::create([
           'nom_service' => $request->nom_service,
           'description' => $request->description,
            'montant' => $request->montant,
            'statut' => 'soumis'
        ]);

        return to_route('soumission')->with('success','Besoin soumis avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(besoin $besoin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(besoin $besoin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, besoin $besoin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(besoin $besoin)
    {
        //
    }
}
