@extends('base')
@section('title')
    Acceuil Chef Departement
@endsection

@section('main-content')
    @include('components.aside-cd')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Analyse de besoins</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                </div>
            </div>
        </nav>
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
    </main>
@endsection

@section('scripts')
@endsection
