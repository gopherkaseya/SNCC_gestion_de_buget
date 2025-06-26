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
                            <h6 class="mb-0">Formulaire de besoins des départements</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            @if (session('success'))
                                <div class="alert alert-success text-white">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="" method="POST">
                                @csrf
                                <div id="besoinsContainer">
                                    <!-- Section pour un besoin -->
                                    <div class="besoin-item mb-3">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Nom du département</label>
                                            <input type="text" class="form-control" name="nom_departement">
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <textarea class="form-control" name="description" placeholder="Description ..." rows="3"></textarea>
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Budget estimé</label>
                                            <input type="number" class="form-control" name="montant">
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Soumettre</button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-7 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Listes de besoins et objectifs</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                @forelse($besoins as $besoin)
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-3 text-sm">{{$besoin->nom_service}}</h6>
                                            <span class="mb-2 text-xs">Description : <span class="text-dark ms-sm-2 font-weight-bold">{{$besoin->description}}</span></span>
                                            <span class="mb-2 text-xs">Budget estimé : <span class="text-dark ms-sm-2 font-weight-bold">{{$besoin->montant}}</span></span>
                                        </div>
                                        <div class="ms-auto text-end">
                                        </div>
                                    </li>
                                @empty
                                    Aucun besoin
                                @endforelse
                            </ul>
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
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
@endsection
