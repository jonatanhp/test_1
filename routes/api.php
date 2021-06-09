<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AlumnoCargaAcadController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CobranzaController;
use App\Http\Controllers\ContratoMatriculaController;
use App\Http\Controllers\CronogramaPagosController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoDocenteSeccionController;
use App\Http\Controllers\DepositoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolUserController;
use App\Http\Controllers\UbigeoController;
use App\Http\Controllers\SeccionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('alumno_cargas', AlumnoCargaAcadController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('cobranzas', CobranzaController::class);
    Route::resource('matriculas', ContratoMatriculaController::class);
    Route::resource('cro_pagos', CronogramaPagosController::class);
    Route::resource('cusos', CursoController::class);
    Route::resource('cargas', CursoDocenteSeccionController::class);
    Route::resource('depositos', DepositoController::class);
    Route::resource('docentes', DocenteController::class);
    Route::resource('grados', GradoController::class);
    Route::resource('niveles', NivelController::class);
    Route::resource('periodos', PeriodoController::class);
    Route::resource('permisos', PermisoController::class);
    Route::resource('representantes', RepresentanteController::class);
    Route::resource('roles', RolController::class);
    Route::resource('rol_users', RolUserController::class);
    Route::resource('secciones', SeccionController::class);
    Route::resource('ubigeos', UbigeoController::class);
    
});