<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Persona;
use App\Models\Colegio;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Asistencia::select("*")->cursorPaginate(5);
        $datosDocente = $this->obtenerDatosDocente();

        return view("registros.asistencias.index", compact("asistencias", "datosDocente"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $persona = Persona::find($id);
        return view("registros.asistencias.show", compact("persona"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function marcarAsistencia() {
        $horaIngreseColegio = "07:30:00";

        $fechaActual = Carbon::now();
        $horaActual = Carbon::now()->format('H:i:s');

        $diferenciaMinutos = $this->calcularDiferenciaHoras($horaIngreseColegio, $horaActual);

        $docente_id = Auth::user()->id;
        $soloFecha = $fechaActual->toDateString();

        $sqlAsistencia = "select *
                        from asistencias
                        where
                        DATE(fecha) = ? and
                        docentes_id = ?;";
        $marcoAsistencia = DB::select($sqlAsistencia, [$soloFecha, $docente_id]);

        if(count($marcoAsistencia) === 1){
            $asistencia = Asistencia::find($marcoAsistencia[0]->id);
            $asistencia->hora_salida = $horaActual;
            $asistencia->update();                    
            return response()->json("Hora salida actualizada");
        }
        else{
            $asistencia = new Asistencia();
            $asistencia->tiempo_retraso = $diferenciaMinutos;
            $asistencia->hora_ingreso = $horaActual;
            $asistencia->hora_salida = $horaActual;
            $asistencia->fecha = $fechaActual;
            $asistencia->docentes_id = $docente_id;
            $asistencia->save();
            return response()->json("Asistencia creada");
        }

    }

    public function calcularDiferenciaHoras($horaInicial, $segundaHora)
    {
        // Convertir las horas a objetos Carbon
        $carbonHoraInicial = Carbon::createFromFormat('H:i:s', $horaInicial);
        $carbonSegundaHora = Carbon::createFromFormat('H:i:s', $segundaHora);

        // Calcular la diferencia en minutos
        $diferenciaEnMinutos = $carbonSegundaHora->diffInMinutes($carbonHoraInicial);

        // Verificar si es un adelanto (+) o retraso (-) y ajustar el mensaje
        if ($carbonSegundaHora > $carbonHoraInicial) {
            $mensaje = "-";
        } else {
            $mensaje = "+";
        }

        // Devolver el resultado en minutos con el mensaje correspondiente
        return $mensaje . abs($diferenciaEnMinutos) . " min";
    }

    // En tu controlador (app/Http/Controllers/TuControlador.php)

    public function obtenerDatosDocente()
    {
        if (Auth::check()) {
            $docentes_id = Auth::user()->id;
            
            // Modifica la consulta para reflejar la relación entre Colegio y Geocerca
            $geocerca = Colegio::where('docentes_id', $docentes_id)
                ->with('geocerca') // Carga la relación geocerca
                ->first();

            if ($geocerca && $geocerca->geocerca) {
                $datosDocente = [
                    'latitud' => $geocerca->geocerca->latitud,
                    'longitud' => $geocerca->geocerca->longitud,
                    'radio' => $geocerca->geocerca->radio,
                ];

                return $datosDocente;
            } else {
                return (['error' => 'No se encontró la geocerca para el docente.']);
            }
        } else {
            return (['error' => 'Usuario no autenticado.']);
        }
    }
}
