<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoIncidenciaController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TecnicoIncidenciaController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MantenimientoPreventivoController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MantenimientoMaquinaController;
use App\Models\MantenimientoMaquina;

Route::prefix('v1')->group(function () {

    Route::prefix('main')->group(function () {
        Route::get('carga-inicial', [MainController::class, 'cargaInicial']);
    });

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:api')->group(function () {
            Route::post('register', [AuthController::class, 'register'])->middleware('admin');
            Route::post('register_tecnico', [AuthController::class, 'registerTecnico'])->middleware('admin');
            Route::get('me', [AuthController::class, 'me']);
            Route::get('me_data', [AuthController::class, 'meData']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::get('validate-token', [AuthController::class, 'validateToken']);
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        });
    });

    Route::prefix('image')->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::post('upload', [ImageController::class, 'upload']);
        });
    });

    

    Route::middleware('auth:api')->group(function () {
        Route::resource('users', UserController::class);
    });

    
    Route::prefix('usuario')->group(function () {
        Route::middleware('auth:api')->group(function () {
           Route::get('all',[UserController::class, 'all']);
           Route::get('show/{usuario}',[UserController::class, 'show'])->middleware('admin');
            Route::put('update/{usuario}',[UserController::class, 'update'])->middleware('admin');
            Route::put('enable/{usuario}',[UserController::class, 'enable'])->middleware('admin');
            Route::put('disable/{usuario}',[UserController::class, 'disable'])->middleware('admin');
          Route::delete('delete/{usuario}',[UserController::class,'destroy'])->middleware('admin');
          Route::put('reset_password',[UserController::class,'resetPassword']);
        });
    });
});

Route::get('/', [AuthController::class, 'unauthorized'])->name('login');