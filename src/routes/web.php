<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\BadgeTypeController;
use App\Http\Controllers\ContratTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\PartenaireVisiteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalarierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\VisitsController;
use App\Models\Salarier;
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
    'middleware' => 'auth',
], function () {
    // Main Page Route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard-analytics');

    // layout

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [AuthController::class, 'user']);

    // Badges
    Route::post('addBadge', [BadgeController::class, 'store']);
    Route::get('badges', [BadgeController::class, 'index']);
    Route::post('/editBadge/{id}', [BadgeController::class, 'update']);
    Route::delete('deleteBadge/{id}', [BadgeController::class, 'destroy']);

    // Badges Types
    Route::post('addBadgeType', [BadgeTypeController::class, 'store']);
    Route::get('badgeTypes', [BadgeTypeController::class, 'index']);
    Route::post('/editBadgeType/{id}', [BadgeTypeController::class, 'update']);
    Route::delete('deleteBadgeType/{id}', [BadgeTypeController::class, 'destroy']);

    // Contrat Types
    Route::post('addContratType', [ContratTypeController::class, 'store']);
    Route::get('contratTypes', [ContratTypeController::class, 'index']);
    Route::post('/editContratType/{id}', [ContratTypeController::class, 'update']);
    Route::delete('deleteContratType/{id}', [ContratTypeController::class, 'destroy']);

    // Salaries
    Route::post('add-salarie', [SalarierController::class, 'store']);
    Route::get('salaries', [SalarierController::class, 'index']);
    Route::post('/editSalarie/{id}', [SalarierController::class, 'update']);
    Route::delete('deleteSalarie/{id}', [SalarierController::class, 'destroy']);
    Route::get('/getData', [SalarierController::class, 'getData']);
    Route::post('/affecteBadge', [SalarierController::class, 'affecteBadge']);
    Route::get('/affecteBadge', [SalarierController::class, 'affectation']);
    Route::post('/desactiveSalarie/{id}', [SalarierController::class, 'desactiver']);
    Route::post('/reactiveSalarie/{id}', [SalarierController::class, 'reactiveSalarie']);


    //Export
    Route::get('/export', [ExportController::class, 'export']);
    Route::post('/exportCSV',[ExportController::class,'exportCSV']);
    Route::post('/exportExcel',[ExportController::class,'exportExcel']);


    // Partenaires
    Route::post('addPartenaire', [PartenaireController::class, 'store']);
    Route::get('partenaires', [PartenaireController::class, 'index']);
    Route::post('/editPartenaire/{id}', [PartenaireController::class, 'update']);
    Route::delete('deletePartenaire/{id}', [PartenaireController::class, 'destroy']);

    //Visits
    Route::get('/addVisit', [VisitsController::class, 'index']);
    Route::post('addVisiteur', [VisitsController::class, 'storeVisiteur']);
    Route::post('addPartenaireVisit', [VisitsController::class, 'storePartenaire']);



    // Visiteurs
    Route::get('visiteurs', [VisiteurController::class, 'index']);
    Route::post('/editVisiteur/{id}', [VisiteurController::class, 'update']);
    Route::delete('deleteVisiteur/{id}', [VisiteurController::class, 'destroy']);
    Route::post('retourBadge/{id}', [VisiteurController::class, 'retour']);

    // Partenaire Visits
    Route::get('partenaireVisits', [PartenaireVisiteController::class, 'index']);
    Route::post('/editPartenaireVisit/{id}', [PartenaireVisiteController::class, 'update']);
    Route::delete('deletePartenaireVisit/{id}', [PartenaireVisiteController::class, 'destroy']);
    Route::post('retourBadgePartenaire/{id}', [PartenaireVisiteController::class, 'retour']);

    //Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('/edit-user/{id}', [SalarierController::class, 'updateUser']);
    Route::delete('delete-user/{id}', [UserController::class, 'destroy']);
    Route::post('add-user',[UserController::class,'store']);

    //Roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/edit-roles/{id}', [RoleController::class, 'updateUser']);
    Route::delete('delete-roles/{id}', [RoleController::class, 'destroy']);
    Route::post('add-roles',[RoleController::class,'store']);


    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::post('users/{user}/assign-role', [RoleController::class, 'assignRole'])->name('users.assign-role');

});
