<?php

use App\Http\Controllers\ControleurGestion;
use App\Http\Controllers\DirecteurGeneral;
use App\Http\Controllers\ResponsableFinance;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});

Route::get('/login',[App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::post('/login',[App\Http\Controllers\AuthController::class,'loginPost'])->name('login.post');

Route::get('/soumission',[App\Http\Controllers\BesoinController::class,'create'])->name('soumission');
Route::post('/soumission', [\App\Http\Controllers\BesoinController::class,'store'])->name('soumission.post');


Route::get('/logout',[App\Http\Controllers\AuthController::class,'logout'])->name('logout');
Route::group(['middleware' => 'auth', 'prefix' => '/chef-departement'], function () {
    Route::get('/',[App\Http\Controllers\ChefDepartementController::class,'index'])->name('chef-departement.index');
    Route::get('/preparer-budget',[\App\Http\Controllers\ChefDepartementController::class,'preparer'])->name('chef-departement.preparer');
    Route::post('/preparer-budget',[\App\Http\Controllers\ChefDepartementController::class,'store'])->name('chef-departement.store');
    Route::get('/analyse-besoin', [\App\Http\Controllers\ChefDepartementController::class, 'analyse'])->name('chef-departement.analyse');
});


Route::group(['middleware' => 'auth', 'prefix' => '/responsable-finance'], function(){
    Route::get('/',[ResponsableFinance::class, 'index'])->name('RF.index');
    Route::get('/consolider', [ResponsableFinance::class, 'consolider'])->name('RF.consolider');
    Route::get('/verifier-budget',[ResponsableFinance::class, 'verifier_budget'])->name('RF.verifier-budget');
    Route::post('/budgets/consolider-ajax', [ResponsableFinance::class, 'consoliderBudgets'])->name('RF.consolider.ajax');
    Route::post('soumettre-dg', [ResponsableFinance::class, 'soumettreBudgetsAuDG'])->name('RF.soumettreDG');
    Route::get('budgets/table', [ResponsableFinance::class, 'tableBudgets'])->name('RF.budgets.table');
    Route::get('/budgets-globaux-non-soumis', [ResponsableFinance::class, 'budgetsGlobalsNonSoumis'])->name('RF.budgets-globaux-non-soumis');
    Route::post('/budget-global/{id}/soumettre', [ResponsableFinance::class, 'soumettreBudgetGlobal'])->name('RF.soumettre-budget-global');

});

Route::group(['middleware' => 'auth', 'prefix' => '/controleur-gestion'], function(){
    Route::get('/', [ControleurGestion::class, 'index'])->name('CG.index');
    Route::get('/execution', [ControleurGestion::class, 'execution'])->name('CG.execution');
    Route::get('/collecter', [ControleurGestion::class, 'collecter'])->name('CG.collecter');
    Route::post('/collecter', [ControleurGestion::class, 'storeExecution'])->name('CG.storeExecution');
    // Les autres routes pour les actions (comparer, rapport, etc.) seront ajoutées ensuite
});

Route::group(['middleware' => 'auth', 'prefix' => '/directeur-general'], function(){
    Route::get('/',[DirecteurGeneral::class, 'index'])->name('directeur-general.index');
    Route::get('/budgets-globaux', [DirecteurGeneral::class, 'budgetsGlobaux'])->name('DG.budgets-globaux');
    Route::get('/budget-global/{id}', [DirecteurGeneral::class, 'showBudgetGlobal'])->name('DG.show-budget-global');
    Route::post('/budget-global/{id}/approuver', [DirecteurGeneral::class, 'approuverBudgetGlobal'])->name('DG.approuver-budget-global');
    Route::post('/budget-global/{id}/demander-modification', [DirecteurGeneral::class, 'demanderModificationBudgetGlobal'])->name('DG.demander-modification-budget-global');
});

Route::get('/create', function () {

        $users = [
            [
                'name' => "John Doe",
                'email' => "john@doe.com",
                'role' => "admin",
                'password' => bcrypt("password"),
            ],
            [
                'name' => "Chef Département",
                'email' => "chef@departement.com",
                'role' => "chefdepartement",
                'password' => bcrypt("password"),
            ],
            [
                'name' => "Responsable Finance",
                'email' => "finance@entreprise.com",
                'role' => "responsablefinance",
                'password' => bcrypt("password"),
            ],
            [
                'name' => "Contrôleur de Gestion",
                'email' => "controleur@gestion.com",
                'role' => "controleurgestion",
                'password' => bcrypt("password"),
            ],
            [
                'name' => "Comptable",
                'email' => "comptable@entreprise.com",
                'role' => "comptable",
                'password' => bcrypt("password"),
            ],
            [
                'name' => "Auditeur Interne",
                'email' => "auditeur@interne.com",
                'role' => "auditeurinterne",
                'password' => bcrypt("password"),
            ],
            [
                'name' => "Directeur Général",
                'email' => "dg@entreprise.com",
                'role' => "directeurgeneral",
                'password' => bcrypt("password"),
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }

        echo "success";
});


Route::fallback(function(){
   return response()->view("errors.404",[],404);
});
