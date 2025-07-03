@extends('base')
@section('title')
    Tableau de bord Directeur Général
@endsection

@section('main-content')
    @include('components.aside-dg')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Bienvenue, Directeur Général</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="row justify-content-center">
                                <div class="col-md-6 text-center">
                                    <h4 class="mb-4">Gestion des Budgets Consolidés</h4>
                                    <a href="{{ route('DG.budgets-globaux') }}" class="btn btn-primary btn-lg mb-3">
                                        📊 Consulter les budgets consolidés
                                    </a>
                                    <p class="text-muted">Consultez, analysez et approuvez les budgets globaux soumis par le Responsable Financier.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
