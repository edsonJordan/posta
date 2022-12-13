<?php
namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Diagnostico;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    if(isset(Auth::user()->name))
    {
        return redirect()->route('web.index');       
    }else{
        return view('welcome');
    }
})->name('index');

Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('home', [WelcomeController::class, 'home'])->name('home')->middleware('auth')->middleware('adminPermission');
Route::get('home-user', [WelcomeController::class, 'homeUser'])->name('home.user')->middleware('auth');

Route::group(['prefix' => 'web'], function() {
    Route::get('inicio', [WelcomeController::class, 'index'])->name('web.index');
});

Route::group(['prefix' => 'performance'], function() {
    Route::get('/', [WelcomeController::class, 'performance'])->name('performance.index')->middleware('auth');
});

Route::group(['middleware'=> 'auth','prefix' => 'usuarios'], function() {
    Route::get('administradores', [UserController::class, 'administradores'])->name('administradores')->middleware('adminPermission');
    Route::get('medicos', [UserController::class, 'medicos'])->name('medicos')->middleware('adminPermission');
    Route::get('farmaceutas', [UserController::class, 'farmaceutas'])->name('farmaceutas')->middleware('adminPermission');
    Route::get('pacientes', [UserController::class, 'pacientes'])->name('pacientes')->middleware('doctorPermission');
    Route::post('store', [UserController::class, 'store'])->name('usuario.store');
    Route::post('update', [UserController::class, 'update'])->name('usuario.update');
});

/* Routes Form extern */
Route::group(['prefix' => 'usuarios'], function () {
    Route::get('/registro', [UserController::class, 'create'])->name('usuarios.registro');
    Route::POST('/registro/paciente', [UserController::class, 'storePaciente'])->name('usuarios.registro.paciente');
});

Route::group(['middleware'=> 'adminPermission', 'middleware'=> 'auth',  'prefix' => 'citas'], function () {
    Route::get('/', [CitasController::class, 'index'])->name('citas');
    Route::get('/citas-sis', [CitasController::class, 'citasSis'])->name('citas-sis');
    Route::post('store', [CitasController::class, 'store'])->name('cita.store');
    Route::post('update', [CitasController::class, 'update'])->name('cita.update');
});


Route::group(['middleware'=> 'adminPermission','middleware'=> 'auth', 'prefix' => 'configuraciones'], function () {
    Route::get('horarios', [BloquesHorariosController::class, 'index'])->name('horarios.index');
    Route::post('bloquesHorarios', [BloquesHorariosController::class, 'store'])->name('horario.store');
    Route::post('updateHorario', [BloquesHorariosController::class, 'update'])->name('horario.update');
    Route::get('clinica', [EmpresaController::class, 'index'])->name('empresa.index');
    Route::post('clinica', [EmpresaController::class, 'update'])->name('empresa.store');
});

Route::group(['middleware'=> 'adminPermission', 'middleware'=> 'auth',   'prefix' => 'servicios'], function () {
    Route::get('/', [ServiciosController::class, 'index'])->name('servicios.index');
    Route::post('servicio', [ServiciosController::class, 'store'])->name('servicio.store');
    Route::post('updateServicio', [ServiciosController::class, 'update'])->name('servicio.update');
});


Route::group(['middleware'=> 'adminPermission', 'middleware'=> 'auth',   'prefix' => 'triajes'], function () {
    Route::get('/', [TriajeController::class, 'index'])->name('triaje.index');
    Route::post('store', [TriajeController::class, 'store'])->name('triaje.store');
});

Route::group(['middleware'=> 'auth',  'middleware'=> 'adminPermission', 'prefix' => 'pagos'], function () {
    Route::get('/', [PagosPacienteController::class, 'index'])->name('pago.index');
    Route::get('realizados', [PagosPacienteController::class, 'realizados'])->name('pago.realizados');
    Route::post('store', [PagosPacienteController::class, 'store'])->name('pago.store');
    Route::get('view/{idPago}', [PagosPacienteController::class, 'view'])->name('pago.view');
});

Route::group(['middleware'=> 'adminPermission' ,'middleware'=> 'auth', 'prefix' => 'diagnostico'], function () {
    Route::get('/', [DiagnosticoController::class, 'index'])->name('diagnostico.index');
    Route::post('/', [DiagnosticoController::class, 'store'])->name('diagnostico.store');
    Route::get('/historia-clinica/{paciente}', [DiagnosticoController::class, 'historiaclinica'])->name('paciente.historiaclinica');
    
});


Route::group(['middleware'=> 'auth', 'prefix' => 'farmacia'], function () {
    Route::get('/', [UserController::class, 'listadoRecetas'])->name('farmacia.index')->middleware('farmaceutaPermission');
    Route::get('/punto-venta', [FarmaciaController::class, 'index'])->name('farmacia.vender');
    Route::get('/medicamentos', [MedicamentosController::class, 'index'])->name('farmacia.medicamentos')->middleware('farmaceutaPermission');
    Route::post('/medicamentos', [MedicamentosController::class, 'store'])->name('farmacia.medicamentos.store');
    Route::post('/medicamento', [MedicamentosController::class, 'update'])->name('farmacia.medicamentos.update');
    Route::get('vender', [FarmaciaController::class, 'index'])->name('farmacia.venta')->middleware('farmaceutaPermission');
    Route::get('ventas', [FarmaciaController::class, 'show'])->name('farmacia.ventas')->middleware('farmaceutaPermission');
    Route::get('factura/{idVenta}', [VentasController::class, 'factura'])->name('factura')->middleware('farmaceutaPermission');
});

Route::group([/* 'middleware'=> 'auth', */ 'prefix' => 'pdfs'], function () {
    Route::get('/receta/{cita}', [PDFController::class, 'receta'])->name('pdf.receta');
    Route::get('/receta/download/{cita}', [PDFController::class, 'recetaDownload'])->name('pdf.download.receta');
    Route::get('/diagnostico/{cita}', [PDFController::class, 'diagnostico'])->name('pdf.diagnostico');
    Route::get('/diagnostico/download/{cita}', [PDFController::class, 'diagnosticoDownload'])->name('pdf.download.diagnostico');
});

/* Routes Pacientes */
Route::group(['middleware'=> 'auth', 'prefix' => 'paciente'], function () {
    Route::get('mis-citas', [CitasController::class, 'misCitas'])->name('mis-citas')->middleware('pacientePermission');
    Route::get('mi-historial', [DiagnosticoController::class, 'Mihistoriaclinica'])->name('mi-historial')->middleware('pacientePermission');
});

/* Routes Medicos */
Route::group(['middleware'=> 'auth', 'prefix' => 'medico'], function () {
    Route::get('mis-citas-m', [CitasController::class, 'misCitasM'])->name('mis-citas-medico')->middleware('doctorPermission');
    Route::get('mi-calendario-m', [CitasController::class, 'miCalendarioM'])->name('mi-calendario-medico')->middleware('doctorPermission');
    Route::get('mis-diagnosticos', [DiagnosticoController::class, 'indexMedico'])->name('mis-diagnostico')->middleware('doctorPermission');
});


Route::group(['middleware'=> 'auth', 'prefix'=> 'calendario'], function (){
    Route::get('citas', [CalendarioController::class, 'index'])->name('calendario.index');
});

// Admin -> 1
// Medico -> 2
// Farmaceutico -> 3
// Paciente -> 4