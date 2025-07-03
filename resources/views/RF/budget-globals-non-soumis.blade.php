@extends('base')
@section('title')
    Budgets globaux non soumis au DG
@endsection

@section('main-content')
    @include('components.aside-rf')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Budgets globaux non soumis au DG</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Montant total</th>
                                            <th>Statut</th>
                                            <th>Date de création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($budgetGlobals as $bg)
                                        <tr>
                                            <td>{{ $bg->id }}</td>
                                            <td>{{ $bg->description }}</td>
                                            <td>{{ number_format($bg->montant_total, 2, ',', ' ') }} F CFA</td>
                                            <td>
                                                @if($bg->statut === 'Soumis au DG')
                                                    <span class="badge bg-success">{{ $bg->statut }}</span>
                                                @else
                                                    <span class="badge bg-warning">{{ $bg->statut }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $bg->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($bg->statut === 'Soumis au DG')
                                                    <button class="btn btn-success btn-sm" disabled>
                                                        ✅ Déjà soumis
                                                    </button>
                                                @else
                                                    <form method="POST" action="{{ route('RF.soumettre-budget-global', $bg->id) }}" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Soumettre ce budget global au DG ?')">
                                                            📤 Soumettre au DG
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun budget global à soumettre.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
