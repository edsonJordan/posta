<?php
namespace App\Http\Controllers;

use App\Models\BloquesHorarios;
use App\Models\Recetas;
use App\Models\RelacionVentas;
use App\Models\Ventas;
use Illuminate\Support\Facades\Route;

Route::get('usuario/{usuario}', [UserController::class, 'get']);
Route::get('getHorariosOcupados/{idMedico}/{fecha}', [CitasController::class, 'getOcupados']);
Route::get('validarDocumento/{document}', [UserController::class, 'validardocumento']);
Route::get('getMedicosByServcicio/{idServicio}', [UserController::class, 'getMedicosByServcicio']);
Route::post('receta', [RecetasController::class, 'store']);
Route::get('receta/{diagnostico}', [RecetasController::class, 'index']);
Route::get('medicamento/{medicamento}', [MedicamentosController::class, 'get']);
Route::post('agregarproducto', [RelacionVentasController::class, 'store']);
Route::get('eliminarVenta/{idRelacion}/{idVenta}', [RelacionVentasController::class, 'eliminar']);
Route::post('guardarVenta', [VentasController::class, 'update']);





/* Calendario api get citas de medico */
Route::get('citasMedico/{user}',                    [CitasController::class, 'getCitasMedico']);
Route::get('citas/',                                [CitasController::class, 'getCitas']);
Route::get('citas/estado',                          [CitasController::class, 'getCitasEstatus']);
Route::get('citas/fecha/{fecha}',                   [CitasController::class, 'getCitasFecha']);
Route::get('citas/{cita}',                          [CitasController::class, 'getCita']);
Route::post('citas/update/{cita}',                  [CitasController::class, 'updateCitas']);
Route::get('calendario/citas',                      [CitasController::class, 'getCalendarioCitas']);
Route::get('horarios/',                             [BloquesHorariosController::class, 'getHorarios']);
Route::get('triaje/{cita}',                         [TriajeController::class, 'getTriaje']);

/* Filtro solo de bloques libres de un medico en una fecha correspondiente y deja seleccionado a la opción que se desea */
Route::get('horarios/bloqueo/{idHorario}/{idMedico}/{fecha}', [BloquesHorariosController::class, 'getHorariosBloqueo']);

/* Horarios Bloqueados para un medico dependiendo del bloque que tiene actualmente*/
Route::get('horarios/ocupados/{fecha}/{servicio}/{bloque}/{medico}', [BloquesHorariosController::class, 'getOcupados']);

/* Bloques libres de un medico en una fecha ---> usada en ruta web.inicio */ 
Route::get('horarios/medico/ocupado/{idMedico}/{fecha}', [BloquesHorariosController::class, 'getHorariosMedicosBloqueo']);
Route::get('ventas/',                               [VentasController::class, 'getVentas']);
Route::get('ventas/usuarios',                       [PagosPacienteController::class, 'getVentasUsuarios']);
Route::get('usuarios/',                             [UserController::class, 'getUsuarios']);
Route::get('usuarios/especialidad/{especialidad}',  [UserController::class, 'getUsuariosEspecialidad']);

Route::get('pdf/cita/{cita}',                       [PDFController::class, 'prueba']);

/* Estadisticas para dashboard */
