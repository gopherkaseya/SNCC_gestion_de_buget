@extends('base')
@section('title')
    Soumission de Besoins
@endsection

@section('main-content')
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                @if (session('success'))
                                    <div class="alert alert-success text-white">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Soumission de Besoins</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" class="text-start" method="POST" action="" autocomplete="off">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Nom agent</label>
                                        <input type="text" name="nom_service" class="form-control" required>
                                    </div>
                                    <div class="input-group input-group-outline my-3">

                                        <textarea name="description" placeholder="Description" class="form-control" rows="4" required></textarea>
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Montant estimé</label>
                                        <input type="number" name="montant" class="form-control" min="1" required>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Soumettre</button>
                                    </div>
                                </form>
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
