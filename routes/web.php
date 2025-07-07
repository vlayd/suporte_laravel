<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ServicoController;
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
        Route::get('novo', [ChamadoController::class, 'novoEdit'])->name('chamado.novo');
        Route::get('edit/{id_chamado}', [ChamadoController::class, 'novoEdit'])->name('chamado.edit');
        Route::get('detail/{id}', [ChamadoController::class, 'detail'])->name('chamado.detail');
        Route::post('deleteanexo', [ChamadoController::class, 'deleteAnexoChamado'])->name('chamado.deleteanexo');
        Route::post('select_services', [ChamadoController::class, 'selectServicos'])->name('chamado.select_services');
        Route::post('save', [ChamadoController::class, 'save'])->name('chamado.save');
        Route::post('sendmessage', [ChamadoController::class, 'saveChat'])->name('chamado.chat');
        Route::get('updatestatus/{id_chamado}/{id_status}', [ChamadoController::class, 'updateStatus'])->name('chamado.updatestatus');
    });

    Route::prefix('categoria')->group(function(){
        Route::get('/', [CategoriaController::class, 'index'])->name('categoria');
        Route::post('save', [CategoriaController::class, 'save'])->name('categoria.save');
    });

    Route::prefix('servico')->group(function(){
        Route::get('/', [ServicoController::class, 'index'])->name('servico');
        Route::post('save', [ServicoController::class, 'save'])->name('servico.save');
    });
});

