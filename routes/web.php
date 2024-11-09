<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/copias-de-seguridad',\App\Livewire\Private\Utilidades\CopiasDeSeguridad::class);
