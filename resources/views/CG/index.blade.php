@extends('base')
@section('title')
    Tableau de bord Contrôleur de Gestion
@endsection

@section('main-content')
    @include('components.aside-cg')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Bienvenue, Contrôleur de Gestion</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="row justify-content-center">
                                <div class="col-md-6 text-center">
                                    <h4 class="mb-4">Suivi de l'exécution du budget</h4>
                                    <a href="{{ route('CG.execution') }}" class="btn btn-primary btn-lg mb-3">
                                        📈 Suivre l'exécution du budget
                                    </a>
                                    <p class="text-muted">Collectez les données, comparez les dépenses et générez des rapports d'exécution budgétaire.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

