<?php

use Illuminate\Support\Facades\Route;

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
