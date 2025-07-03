@extends('base')
@section('title')
    Suivi de l'exécution du budget
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
                                <h6 class="text-white text-capitalize ps-3">Suivi de l'exécution du budget global</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mb-4">
                                <a href="{{ route('CG.collecter') }}" class="btn btn-primary btn-lg">Collecter les données d'exécution</a>
                                <a href="#" class="btn btn-info btn-lg">Comparer dépenses réelles et prévisions</a>
                                <a href="#" class="btn btn-success btn-lg">Générer un rapport d'exécution</a>
                                <a href="#" class="btn btn-dark btn-lg">Partager le rapport</a>
                                <a href="#" class="btn btn-danger btn-lg">Alerter le DG</a>
                            </div>
                            <div class="alert alert-info mt-4">
                                <strong>Astuce :</strong> Utilisez les boutons ci-dessus pour suivre l'exécution du budget, générer et partager des rapports, ou alerter le DG en cas d'écart important.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
