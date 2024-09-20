<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\BadgeTypeController;
use App\Http\Controllers\ContratTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\NoteCategorieController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteSubCategorieController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\PartenaireVisiteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalarierController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\VisitsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

    Route::group([
        'prefix' => 'auth',
    ], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

    });
});

Route::group([
    'middleware' => ['auth', 'action.logger'],
], function () {
    // Main Page Route
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    // layout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [AuthController::class, 'user']);

    // Badges
    Route::post('add-badge', [BadgeController::class, 'store'])->middleware('check.permission:add-badge');
    Route::get('badges', [BadgeController::class, 'index'])->middleware('check.permission:badges')->name('badges');
    Route::post('/edit-badge/{id}', [BadgeController::class, 'update'])->middleware('check.permission:edit-badge');
    Route::delete('delete-badge/{id}', [BadgeController::class, 'destroy'])->middleware('check.permission:delete-badge');

    // Badges Types
    Route::post('add-badge-type', [BadgeTypeController::class, 'store'])->middleware('check.permission:add-type-badge');
    Route::get('badge-types', [BadgeTypeController::class, 'index'])->middleware('check.permission:type-badges')->name('type-badges');
    Route::post('/edit-badge-type/{id}', [BadgeTypeController::class, 'update'])->middleware('check.permission:edit-type-badge');
    Route::delete('delete-badge-type/{id}', [BadgeTypeController::class, 'destroy'])->middleware('check.permission:delete-type-badge');

    // Contrat Types
    Route::post('add-contrat-type', [ContratTypeController::class, 'store'])->middleware('check.permission:add-type-contrat');
    Route::get('contrat-types', [ContratTypeController::class, 'index'])->middleware('check.permission:type-contrats')->name('type-contrats');
    Route::post('/edit-contrat-type/{id}', [ContratTypeController::class, 'update'])->middleware('check.permission:edit-type-contrat');
    Route::delete('delete-contrat-type/{id}', [ContratTypeController::class, 'destroy'])->middleware('check.permission:delete-type-contrat');

    // Salaries
    Route::post('add-salarie', [SalarierController::class, 'store'])->middleware('check.permission:add-salarie');
    Route::get('add-salarie',[SalarierController::class,'create'])->middleware('check.permission:add-salarie')->name('salaries');
    Route::get('salaries', [SalarierController::class, 'index'])->name('salaries')->middleware('check.permission:salaries');
    Route::post('/edit-salarie/{id}', [SalarierController::class, 'update'])->middleware('check.permission:edit-salarie');
    Route::get('edit-salarie/{id}',[SalarierController::class,'edit'])->middleware('check.permission:edit-salarie')->name('salaries');
    Route::get('show-salarie/{id}',[SalarierController::class,'show'])->middleware('check.permission:show-salarie')->name('salaries');
    Route::delete('delete-salarie/{id}', [SalarierController::class, 'destroy'])->middleware('check.permission:delete-salarie');
    Route::get('/get-data', [SalarierController::class, 'getData']);
    Route::post('/affecte-badge', [SalarierController::class, 'affecteBadge'])->middleware('check.permission:affecte-badge');
    Route::get('/affecte-badge', [SalarierController::class, 'affectation'])->middleware('check.permission:affecte-badge')->name('affecte-badge');
    Route::post('/desactive-salarie/{id}', [SalarierController::class, 'desactiver'])->middleware('check.permission:desactive-salarie');
    Route::post('/reactive-salarie/{id}', [SalarierController::class, 'reactiveSalarie'])->middleware('check.permission:active-salarie');

    //Export
    Route::get('/export', [ExportController::class, 'export'])->middleware('check.permission:rapports')->name('rapports');
    Route::post('/exportCSV', [ExportController::class, 'exportCSV'])->middleware('check.permission:rapports');
    Route::post('/exportExcel', [ExportController::class, 'exportExcel'])->middleware('check.permission:rapports');

    // Partenaires
    Route::post('add-partenaire', [PartenaireController::class, 'store'])->middleware('check.permission:add-partenaire');
    Route::get('partenaires', [PartenaireController::class, 'index'])->middleware('check.permission:partenaires')->name('partenaires');
    Route::post('/edit-partenaire/{id}', [PartenaireController::class, 'update'])->middleware('check.permission:edit-partenaire');
    Route::delete('delete-partenaire/{id}', [PartenaireController::class, 'destroy'])->middleware('check.permission:delete-partenaire');

    //Visits
    Route::get('/add-visit', [VisitsController::class, 'index'])->middleware('check.permission:add-visit')->name('add-visit');
    Route::post('add-visiteur', [VisitsController::class, 'storeVisiteur'])->middleware('check.permission:add-visit');
    Route::post('add-partenaire-visit', [VisitsController::class, 'storePartenaire'])->middleware('check.permission:add-visit-partenaire');

    // Visiteurs
    Route::get('visiteurs', [VisiteurController::class, 'index'])->middleware('check.permission:visits')->name('visits');
    Route::post('/edit-visiteur/{id}', [VisiteurController::class, 'update'])->middleware('check.permission:edit-visit');
    Route::delete('delete-visiteur/{id}', [VisiteurController::class, 'destroy'])->middleware('check.permission:delete-visit');
    Route::post('retour-badge/{id}', [VisiteurController::class, 'retour'])->middleware('check.permission:retour-badge');

    // Partenaire Visits
    Route::get('partenaire-visits', [PartenaireVisiteController::class, 'index'])->middleware('check.permission:visit-partenaire')->name('visit-partenaire');
    Route::post('/edit-partenaire-visit/{id}', [PartenaireVisiteController::class, 'update'])->middleware('check.permission:edit-visit-partenaire');
    Route::delete('delete-partenaire-visit/{id}', [PartenaireVisiteController::class, 'destroy'])->middleware('check.permission:delete-visit-partenaire');
    Route::post('retour-badge-partenaire/{id}', [PartenaireVisiteController::class, 'retour'])->middleware('check.permission:retour-badge');

    //Users
    Route::get('users', [UserController::class, 'index'])->middleware('check.permission:users')->name('users');
    Route::post('/edit-user/{id}', [SalarierController::class, 'updateUser'])->middleware('check.permission:edit-user');
    Route::delete('delete-user/{id}', [UserController::class, 'destroy'])->middleware('check.permission:delete-user');
    Route::post('add-user', [UserController::class, 'store'])->middleware('check.permission:add-user');

    //Roles
    Route::get('roles', [RoleController::class, 'index'])->middleware('check.permission:roles')->name('roles');
    Route::post('/edit-role/{id}', [RoleController::class, 'update'])->middleware('check.permission:edit-role');
    Route::delete('delete-role/{id}', [RoleController::class, 'destroy'])->middleware('check.permission:delete-role');
    Route::post('add-role', [RoleController::class, 'store'])->middleware('check.permission:add-role');

    //Permissions
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions')->middleware('check.permission:permissions');
    Route::post('/edit-permission/{id}', [PermissionController::class, 'update'])->middleware('check.permission:edit-permission');
    Route::delete('delete-permission/{id}', [PermissionController::class, 'destroy'])->middleware('check.permission:delete-permission');
    Route::post('add-permission', [PermissionController::class, 'store'])->middleware('check.permission:add-permission');

    // Note Categorie
    Route::post('add-note-categorie', [NoteCategorieController::class, 'store'])->middleware('check.permission:add-categorie-note');
    Route::get('note-categories', [NoteCategorieController::class, 'index'])->middleware('check.permission:categorie-notes')->name('categorie-notes');
    Route::post('/edit-note-categorie/{id}', [NoteCategorieController::class, 'update'])->middleware('check.permission:edit-categorie-note');
    Route::delete('delete-note-categorie/{id}', [NoteCategorieController::class, 'destroy'])->middleware('check.permission:delete-categorie-note');

    // Note Sub Categorie
    Route::post('add-note-sub-categorie', [NoteSubCategorieController::class, 'store'])->middleware('check.permission:add-sous-categorie-note');
    Route::get('note-sub-categories', [NoteSubCategorieController::class, 'index'])->middleware('check.permission:sous-categorie-notes')->name('sous-categorie-notes');
    Route::post('/edit-note-sub-categorie/{id}', [NoteSubCategorieController::class, 'update'])->middleware('check.permission:edit-sous-categorie-note');
    Route::delete('delete-note-sub-categorie/{id}', [NoteSubCategorieController::class, 'destroy'])->middleware('check.permission:delete-sous-categorie-note');

    // Services
    Route::post('add-service', [ServiceController::class, 'store'])->middleware('check.permission:add-service');
    Route::get('services', [ServiceController::class, 'index'])->middleware('check.permission:services')->name('services');
    Route::post('/edit-service/{id}', [ServiceController::class, 'update'])->middleware('check.permission:edit-service');
    Route::delete('delete-service/{id}', [ServiceController::class, 'destroy'])->middleware('check.permission:delete-service');

    //Notes
    Route::get('show-note/{remarques}',[NoteController::class,'show'])->middleware('check.permission:show-note')->name('evaluations');
    Route::get('notes',[NoteController::class,'index'])->middleware('check.permission:evaluations')->name('evaluations');
    Route::get('evaluate',[NoteController::class,'evaluate'])->middleware('check.permission:evaluate')->name('evaluate');
    Route::post('fiche-evaluation',[NoteController::class,'create'])->middleware('check.permission:evaluate')->name('evaluate');
    Route::post('fiche-evaluation-store',[NoteController::class,'store'])->name('fiche-evaluation-store')->middleware('check.permission:evaluate');
    Route::get('/download-pdf/{filename}', [NoteController::class,'downloadPDF'])->name('download.pdf')->middleware('check.permission:download-note');
    Route::get('edit-note/{id}',[NoteController::class,'edit'])->middleware('check.permission:edit-note')->name('evaluate');
    Route::post('edit-note/{id}',[NoteController::class,'update'])->name('fiche-evaluation-edit')->middleware('check.permission:edit-note');
    Route::delete('delete-note/{id}',[NoteController::class,'destroy'])->middleware('check.permission:delete-note');

    //Documents
    Route::post('add-document', [DocumentController::class, 'store'])->middleware('check.permission:add-type-document');
    Route::get('documents', [DocumentController::class, 'index'])->middleware('check.permission:type-documents')->name('type-documents');
    Route::post('/edit-document/{id}', [DocumentController::class, 'update'])->middleware('check.permission:edit-type-document');
    Route::delete('delete-document/{id}', [DocumentController::class, 'destroy'])->middleware('check.permission:delete-type-document');
    Route::get('/contrat-types/{id}/documents', [ContratTypeController::class, 'getDocuments']);
    Route::get('documents/download/{path}', [DocumentController::class, 'download'])->where('path', '.*')->name('documents.download');


    Route::get('/profile',[UserController::class,'showProfile']);
    Route::post('edit-password',[UserController::class,'editPassword']);
    Route::get('/logs/{id}',[UserController::class,'logs'])->middleware('check.permission:logs-salarie')->name('salaries');
    Route::get('/logs',[UserController::class,'allLogs'])->middleware('check.permission:logs')->name('logs');
});
