<?php

namespace App\Http\Controllers;

use App\Models\Geocerca;
use App\Models\Docente;
use App\Models\Colegio;
use Illuminate\Http\Request;

class GeocercaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Geocerca::select("*")->cursorPaginate(5);
        $docentes = Docente::with('persona')->get();
        return view("geocerca.create", compact('docentes'));
    }

    public function store(Request $request){
        try {
            $request->validate([
                'latitud' => 'required',
                'longitud' => 'required',
                'radio' => 'required',
                'startTime' => 'required',
                'endTime' => 'required',
                'nombre' => 'required',
                'docentes' => 'required|array',
            ]);
    
            $data = [
                'latitud' => $request->input('latitud'),
                'longitud' => $request->input('longitud'),
                'radio' => $request->input('radio'),
                'hora_inicio' => $request->input('startTime'),
                'hora_fin' => $request->input('endTime'),
                'nombre' => $request->input('nombre'),
            ];
    
            $geocercaExistente = Geocerca::firstOrCreate(['nombre' => $data['nombre']], $data);
    
            $docentesSeleccionados = $request->input('docentes');
    
            foreach ($docentesSeleccionados as $docenteId) {
                $relacionExistente = Colegio::where('docentes_id', $docenteId)->first();
    
                if (!$relacionExistente) {
                    Colegio::create([
                        'docentes_id' => $docenteId,
                        'geocerca_id' => $geocercaExistente->id,
                    ]);
                }
            }
    
            $message = $geocercaExistente->wasRecentlyCreated ? "Geocerca creada y docentes añadidos con éxito" : "Docentes añadidos a la Geocerca existente";
    
            return back()->with("info", $message);
        } catch (\Exception $e) {
            return back()->with("error", "Error al guardar la ubicación y asociaciones");
        }
    }
}    