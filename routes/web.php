<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuestosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InicioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('login', function(){
    return view('layouts.login');
})->name('login');

Route::post('auth', [AuthController::class, 'Authenticate'])->name('us.auth');
Route::get('logauth', [AuthController::class, 'Logout'])->name('us.logout');


///Inicio
Route::get('/', [InicioController::class, 'index'])->name('admin');

/* ***RECURSOS HUMANOS*** */
/*  CATALOGOS */
//puestos
Route::get('puestos', [PuestosController::class, 'index'])->name('puestos');
Route::post('puestos/save', [PuestosController::class, 'save'])->name('puestos.save');
Route::get('puestos/listar', [PuestosController::class, 'listar'])->name('puestos.listar');
Route::get('puestos/listarselect', [PuestosController::class, 'listarSelect'])->name('puestos.listarselect');
Route::post('puestos/eliminar', [PuestosController::class, 'delete'])->name('puestos.eliminar');

//empresas
Route::get('empresas', [EmpresasController::class, 'index'])->name('empresas');
Route::get('empresas/listar', [EmpresasController::class, 'listar'])->name('empresas.listar');
Route::get('empresas/listarselect', [EmpresasController::class, 'listarSelect'])->name('empresas.listarselect');
Route::post('empresas/save', [EmpresasController::class, 'save'])->name('empresas.save');
Route::post('empresas/eliminar', [EmpresasController::class, 'delete'])->name('empresas.eliminar');

/* EMPLEADOS */
//Empleados
Route::get('empleados', [EmpleadosController::class, 'index'])->name('empleados');
Route::get('empleados/listar', [EmpleadosController::class, 'listar'])->name('empleados.listar');
Route::get('empleados/listarselect', [EmpleadosController::class, 'listarSelect'])->name('empleados.listarselect');
Route::post('empleados/save', [EmpleadosController::class, 'save'])->name('empleados.save');
Route::post('empleados/baja', [EmpleadosController::class, 'baja'])->name('empleados.baja');

/* ***SISTEMA*** */
/* CATALOGOS */
//ROLES
Route::get('roles', [RolesController::class, 'index'])->name('roles');
Route::get('roles/listar', [RolesController::class, 'listar'])->name('roles.listar');
Route::get('roles/listarselect', [RolesController::class, 'listarSelect'])->name('roles.listarselect');
Route::post('roles/save', [RolesController::class, 'save'])->name('roles.save');
Route::post('roles/eliminar', [RolesController::class, 'delete'])->name('roles.eliminar');


/* USUARIOS */
//USUARIOS
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios');
Route::get('usuarios/listar', [UsuariosController::class, 'listar'])->name('usuarios.listar');
Route::post('usuarios/save', [UsuariosController::class, 'save'])->name('usuarios.save');
Route::post('usuarios/baja', [UsuariosController::class, 'desactivar'])->name('usuarios.baja');
