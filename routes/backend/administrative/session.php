<?php

use Illuminate\Support\Facades\Route;

// ADMINISTRATIVE - SESSIONS
Route::group([
    'as' => 'dashboard.system.administrative.sessions.',
    'prefix' => 'dashboard/administratives/sessions',
    'namespace' => 'App\Http\Controllers\Backend\__System\Administrative',
    'middleware' => ['auth', 'verified'],
], function () {
    Route::get('reset', 'SessionController@reset')->name('reset');
    Route::get('/', 'SessionController@index');
});
