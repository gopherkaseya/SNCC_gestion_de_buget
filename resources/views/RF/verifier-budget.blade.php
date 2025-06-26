@extends('base')
@section('title')
    Acceuil Chef Departement
@endsection

@section('main-content')
    @include('components.aside-rf')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Acceuil</li>
                    </ol>
                </nav>
                 <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <li class="nav-item d-flex align-items-center">

                            <i class="material-symbols-rounded">account_circle</i>
                            <span class="nav-link-text ms-1">{{Auth::user()->name}}</span>
                    </li>
                 </div>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav d-flex align-items-center  justify-content-end">


                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Besoins & objectifs</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">

                                <div id="budget-table-container">
                                    @include('components.budget-table', ['budgets' => $budgets])
                                </div>

                            <div class="d-flex justify-content-center gap-3 mt-4 mb-4">

                                <button type="button" id="btn-consolider" class="btn btn-success">
                                    🔗 Consolider les budgets
                                </button>

                                <form method="POST" action="">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">
                                        📤 Soumettre au DG
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>

            <footer class="footer py-4">

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
        document.getElementById('btn-consolider').addEventListener('click', function () {
            fetch('{{ route('RF.consolider.ajax') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recharge le tableau
                        fetch('{{ route('RF.budgets.table') }}')
                            .then(resp => resp.text())
                            .then(html => {
                                document.getElementById('budget-table-container').innerHTML = html;
                            });
                    } else {
                        alert('❌ Erreur : ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur AJAX :', error);
                    alert('❌ Une erreur est survenue.');
                });
        });

    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
@endsection
