<?php

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\FaltaController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\GradoMateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\JuntaEscolarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GeocercaController;
use App\Models\Geocerca;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("login", [LoginController::class, "ingresar"])->name("login.ingresar");
Route::get('/mapa', function () {
    return view('welcome');
});
Route::group(["middleware" => 'auth'], function() {
    
    Route::get("login/logout", [LoginController::class, "logout"])->name("login.logout");
    
    Route::get('/home', function () {
        return view('layout');
    });

    Route::get("/temas", function() {
        return view("temas");
    })->name("temas");

    Route::get("/temas", function() {
        return view("temas");
    })->name("temas");

    Route::resource("personas", PersonaController::class)->names("personas");
    Route::get("personas/roles/create/{persona}", [PersonaController::class, "createRole"])->name("createRole");
    Route::post("personas/roles/{persona}", [PersonaController::class, "storeRole"])->name("storeRole");

    Route::post('personas/buscar', [PersonaController::class, "buscar"]);
    Route::post('personas/buscarForCI', [PersonaController::class, "buscarForCI"]);

    Route::resource("junta-escolar", JuntaEscolarController::class)->names("juntas");
    Route::post('junta-escolar/buscar', [JuntaEscolarController::class, "buscar"]);

    Route::resource("roles", RoleController::class)->names("roles");

    Route::resource("materias", MateriaController::class)->names("materias");
    Route::resource("grados", GradoController::class)->names("grados");
    Route::resource("aulas", AulaController::class)->names("aulas");

    Route::resource("grados-materias", GradoMateriaController::class)->names("gradosmaterias");
    Route::get("grados-materias/horarios/create/{gradoMateria}", [GradoMateriaController::class, "createHorario"])->name("createHorario");
    Route::post("grados-materias/horarios/{gradoMateria}", [GradoMateriaController::class, "storeHorario"])->name("storeHorario");

    Route::resource("faltas", FaltaController::class)->names("faltas");
    Route::post('faltas/buscar', [FaltaController::class, "buscarFaltas"]);

    Route::resource("asistencias", AsistenciaController::class)->names("asistencias");

    Route::get("mapas/confirmar", [AsistenciaController::class, "confirmarAsistencia"]);
    Route::post("asistencias/marcar", [AsistenciaController::class, "marcarAsistencia"]);

    Route::resource("geocercas", GeocercaController::class)->names("geocercas");



    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/obtener-datos-docente', [AsistenciaController::class, 'obtenerDatosDocente'])->name('obtener-datos-docente');

});
