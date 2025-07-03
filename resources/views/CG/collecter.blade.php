@extends('base')
@section('title')
    Collecte des données d'exécution du budget
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
                                <h6 class="text-white text-capitalize ps-3">Collecte des données d'exécution</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <form method="POST" action="{{ route('CG.storeExecution') }}">
                                @csrf
                                <div class="mb-3 input-group input-group-outline">
                                    <label for="departement" class="form-label">Département</label>
                                    <input type="text" class="form-control" id="departement" name="departement" required>
                                </div>
                                <div class="mb-3 input-group input-group-outline">
                                    <label for="montant_reel" class="form-label">Montant dépensé réel</label>
                                    <input type="number" step="0.01" class="form-control" id="montant_reel" name="montant_reel" required>
                                </div>
                                <div class="mb-3 input-group input-group-outline">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enregistrer la dépense</button>
                                <a href="{{ route('CG.execution') }}" class="btn btn-secondary ms-2">Retour</a>
                            </form>
                            <div class="alert alert-info mt-4">
                                <strong>Astuce :</strong> Saisissez les dépenses réelles par département. Vous pourrez ensuite comparer avec les prévisions et générer un rapport d'exécution.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script src="{{asset('../assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('../assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('../assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('../assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
@endsection
