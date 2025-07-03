@extends('base')
@section('title')
    Preparation du budget
@endsection

@section('main-content')
    @include('components.aside-cd')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Preparation du budget</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-2">

            <div class="row">

                <div class="col-md-5 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Formulaire de creation de budget</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            @if (session('success'))
                                <div class="alert alert-success text-white">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="" method="POST">
                                @csrf
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Nom du département</label>
                                    <input type="text" class="form-control" name="nom_departement" required>
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <textarea class="form-control" name="description" placeholder="Description ..." rows="3" required></textarea>
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Budget estimé</label>
                                    <input type="text" class="form-control" name="montant_affiche" id="montant_affiche" readonly>
                                    <input type="hidden" name="montant" id="montant_valeur">
                                </div>


                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Associer des besoins existants</label>
                                    <select class="form-control mt-6"  name="besoin_ids[]" multiple size="5" required>
                                        @foreach($besoins as $besoin)
                                            @if($besoin->budget_id === null)
                                                <option value="{{ $besoin->id }}" data-montant="{{ $besoin->montant }}">
                                                    {{ $besoin->nom_service }} - {{ number_format($besoin->montant, 0, ',', ' ') }} FC
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Appuyez sur Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs besoins</small>
                                </div>

                                <button type="submit" class="btn btn-success">Soumettre</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer py-4  ">

            </footer>
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
    <script>
        document.getElementById('addBesoin').addEventListener('click', function() {
            const container = document.getElementById('besoinsContainer');
            const newBesoin = document.querySelector('.besoin-item').cloneNode(true);
            newBesoin.querySelectorAll('input').forEach(input => input.value = '');
            container.appendChild(newBesoin);
        });

        document.getElementById('besoinsContainer').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-besoin')) {
                if (document.querySelectorAll('.besoin-item').length > 1) {
                    event.target.parentElement.remove();
                }
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectBesoins = document.querySelector('select[name="besoin_ids[]"]');
            const montantAffiche = document.getElementById('montant_affiche');
            const montantValeur = document.getElementById('montant_valeur');

            function formatNombre(nombre) {
                return nombre.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + " FC";
            }

            selectBesoins.addEventListener('change', function () {
                let total = 0;
                const selectedOptions = Array.from(this.selectedOptions);

                selectedOptions.forEach(option => {
                    const montant = parseFloat(option.getAttribute('data-montant'));
                    if (!isNaN(montant)) {
                        total += montant;
                    }
                });

                montantValeur.value = total; // valeur brute
                montantAffiche.value = formatNombre(total); // valeur formatée
            });
        });
    </script>
    <script>
        function updateFilledState(input) {
            if (input.value.trim() !== "") {
                input.parentElement.classList.add('is-filled');
            } else {
                input.parentElement.classList.remove('is-filled');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const montantAffiche = document.getElementById('montant_affiche');

            // Au chargement, applique la classe si une valeur existe
            updateFilledState(montantAffiche);

            // À chaque mise à jour du champ
            montantAffiche.addEventListener('input', function () {
                updateFilledState(this);
            });

            // Si tu modifies sa valeur via JavaScript :
            // ex. montantAffiche.value = "100 000 FCFA"; updateFilledState(montantAffiche);
        });
    </script>




    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
@endsection
