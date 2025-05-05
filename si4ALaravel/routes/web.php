<?php
use App\Http\Controllers\ProdiController;//jangan lupa import
use App\Http\Controllers\FakultasController;//jangan lupa import
use App\Http\Controllers\MahasiswaController;//jangan lupa import
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/profil',function (){
    return view('profil');
});

route::resource('/fakultas',FakultasController::class);
route::resource('/prodi',ProdiController::class);
route::resource('/mahasiswa',MahasiswaController::class);