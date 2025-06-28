<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('index');

//Se não logado
Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

//Se logado
Route::middleware([CheckIsLogged::class])->group(function(){
    Route::prefix('chamado')->group(function(){
        Route::get('/', [ChamadoController::class, 'index'])->name('chamado');
        Route::get('listar', [ChamadoController::class, 'listar'])->name('chamado.listar');
        Route::get('listar30', [ChamadoController::class, 'listar30'])->name('chamado.listar30');
        Route::get('novo', [ChamadoController::class, 'novo'])->name('chamado.novo');
        Route::get('detail/{id}', [ChamadoController::class, 'detail'])->name('chamado.detail');
        Route::post('select_services', [ChamadoController::class, 'selectServicos'])->name('chamado.select_services');
        Route::post('insert', [ChamadoController::class, 'save'])->name('chamado.insert');
    });
});

