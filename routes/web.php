<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/templates', function () {
    return view('layouts.backend.__templates.index');
});

Route::get('/js/lang.js', function () {
    $lang = config('app.locale');
    $files = glob(base_path('lang/' . $lang . '/*.php'));
    $strings = [];
    foreach ($files as $file) {
        $name = basename($file, '.php');
        $strings[$name] = require $file;
    }
    return $strings;
    header('Content-Type: text/javascript');
    return ('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');

// DATATABLES - GENERALS
Route::group([
    'as' => 'dashboard.system.application.datatable.generals.',
    'prefix' => 'dashboard/applications/datatables/generals',
    'namespace' => 'App\Http\Controllers\Backend\__System\Application\Datatable',
    // 'middleware' => ['auth', 'verified', 'role:master-administrator'],
], function () {
    Route::get('chart', 'GeneralController@chart')->name('chart');
    Route::get('active/{id?}', 'GeneralController@active')->name('active');
    Route::get('activities', 'GeneralController@activity')->name('activity');
    Route::get('delete/{id?}', 'GeneralController@delete')->name('delete');
    Route::get('delete-permanent/{id?}', 'GeneralController@delete_permanent')->name('delete-permanent');
    Route::get('inactive/{id?}', 'GeneralController@inactive')->name('inactive');
    Route::get('restore/{id?}', 'GeneralController@restore')->name('restore');
    Route::get('selected-active', 'GeneralController@selected_active')->name('selected-active');
    Route::get('selected-inactive', 'GeneralController@selected_inactive')->name('selected-inactive');
    Route::get('selected-delete', 'GeneralController@selected_delete')->name('selected-delete');
    Route::get('selected-delete-permanent', 'GeneralController@selected_delete_permanent')->name('selected-delete-permanent');
    Route::get('selected-restore', 'GeneralController@selected_restore')->name('selected-restore');
    Route::get('trash', 'GeneralController@trash')->name('trash');
    Route::resource('/', 'GeneralController')->parameters(['' => 'id']);
});
