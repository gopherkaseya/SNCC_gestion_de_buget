<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">SNCC Bugdet</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'RF.index' ? 'bg-gradient-dark text-white' : 'text-dark' }}  " href="{{route('RF.index')}}">
                    <i class="material-symbols-rounded opacity-5">home</i>
                    <span class="nav-link-text ms-1">Acceuil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'RF.verifier-budget' ? 'bg-gradient-dark text-white' : 'text-dark' }}  " href="{{route('RF.verifier-budget')}}">
                    <i class="material-symbols-rounded opacity-5">check</i>
                    <span class="nav-link-text ms-1">Verifer budgets</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'RF.budgets-globaux-non-soumis' ? 'bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('RF.budgets-globaux-non-soumis') }}">
                    <i class="material-symbols-rounded opacity-5">account_balance_wallet</i>
                    <span class="nav-link-text ms-1">Budgets globaux</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('logout')}}">
                    <i class="material-symbols-rounded opacity-5">logout</i>
                    <span class="nav-link-text ms-1">Se deconnecter</span>
                </a>
            </li>


        </ul>
    </div>
</aside>
