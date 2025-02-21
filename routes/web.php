<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get("/excel", \App\Livewire\ExcelComp::class);;
