@extends('base')
@section('title')
    Budgets globaux soumis
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
                                <h6 class="text-white text-capitalize ps-3">Budgets globaux soumis à l'approbation</h6>
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($budgetGlobals as $bg)
                                        <tr>
                                            <td>{{ $bg->id }}</td>
                                            <td>{{ $bg->description }}</td>
                                            <td>{{ number_format($bg->montant_total, 2, ',', ' ') }} F CFA</td>
                                            <td>
                                                @if($bg->statut === 'Approuvé')
                                                    <span class="badge bg-success">{{ $bg->statut }}</span>
                                                @elseif($bg->statut === 'Modifications demandées')
                                                    <span class="badge bg-danger">{{ $bg->statut }}</span>
                                                @else
                                                    <span class="badge bg-warning">{{ $bg->statut }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $bg->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('DG.show-budget-global', $bg->id) }}" class="btn btn-info btn-sm mb-1">Analyser</a>
                                                @if($bg->statut === 'Soumis au DG')
                                                    <form method="POST" action="{{ route('DG.approuver-budget-global', $bg->id) }}" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm mb-1" onclick="return confirm('Approuver ce budget global ?')">
                                                            ✅ Approuver
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modifModal{{ $bg->id }}">
                                                        ✏️ Demander modifications
                                                    </button>
                                                    <!-- Modal pour commentaire -->
                                                    <div class="modal fade" id="modifModal{{ $bg->id }}" tabindex="-1" aria-labelledby="modifModalLabel{{ $bg->id }}" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="modifModalLabel{{ $bg->id }}">Demander des modifications</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <form method="POST" action="{{ route('DG.demander-modification-budget-global', $bg->id) }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                              <div class="mb-3">
                                                                <label for="commentaire{{ $bg->id }}" class="form-label">Commentaire</label>
                                                                <textarea class="form-control" id="commentaire{{ $bg->id }}" name="commentaire" required></textarea>
                                                              </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                              <button type="submit" class="btn btn-danger">Envoyer la demande</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun budget global à traiter.</td>
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

