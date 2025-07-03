@extends('base')
@section('title')
    Détail du budget global
@endsection

@section('main-content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Détail du budget global #{{ $budgetGlobal->id }}</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <h5>Description :</h5>
                            <p>{{ $budgetGlobal->description }}</p>
                            <h5>Montant total :</h5>
                            <p><strong>{{ number_format($budgetGlobal->montant_total, 2, ',', ' ') }} F CFA</strong></p>
                            <h5>Statut :</h5>
                            <p>
                                @if($budgetGlobal->statut === 'Approuvé')
                                    <span class="badge bg-success">{{ $budgetGlobal->statut }}</span>
                                @elseif($budgetGlobal->statut === 'Modifications demandées')
                                    <span class="badge bg-danger">{{ $budgetGlobal->statut }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $budgetGlobal->statut }}</span>
                                @endif
                            </p>
                            <hr>
                            <h5>Budgets départementaux consolidés :</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Département</th>
                                            <th>Description</th>
                                            <th>Montant</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($budgets as $budget)
                                        <tr>
                                            <td>{{ $budget->nom_departement }}</td>
                                            <td>{{ $budget->description }}</td>
                                            <td>{{ number_format($budget->montant, 2, ',', ' ') }} F CFA</td>
                                            <td>{{ $budget->statut }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('DG.budgets-globaux') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

