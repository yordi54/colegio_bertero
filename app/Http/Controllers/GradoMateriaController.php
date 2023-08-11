<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Dia;
use App\Models\Docente;
use App\Models\Grado;
use App\Models\GradoMateria;
use App\Models\Hora;
use App\Models\Horario;
use App\Models\Materia;
use App\Rules\CreateGradoMateriaUniqueData;
use App\Rules\CreateHorarioForMateriaUniqueData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradoMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gradosMaterias = GradoMateria::all();
        return view("pedagogico.grado-materias.index", compact("gradosMaterias"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materias = Materia::all();
        $grados = Grado::all();
        $docentes = Docente::all();

        $aulas = Aula::all();
        $dias = Dia::all();
        $horas = Hora::all();
        
        return view("pedagogico.grado-materias.create", compact("materias", "grados", "docentes", "aulas", "dias", "horas"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $grado_id = $request->grado;
        $materia_id = $request->materia;
        $docente_id = $request->docente;
        $fechaActual = Carbon::now();

        $request->validate([
            "grado" => ["required", new CreateGradoMateriaUniqueData($grado_id, $materia_id) ],
            "materia" => ["required", new CreateGradoMateriaUniqueData($grado_id, $materia_id) ]
        ]);

        $gradoMateria = new GradoMateria();
        $gradoMateria->fecha_creacion = $fechaActual;
        $gradoMateria->grados_id = $grado_id;
        $gradoMateria->materias_id = $materia_id;
        $gradoMateria->docentes_id = $docente_id;
        $gradoMateria->save();

        return redirect()->route("gradosmaterias.index")->with("info", "GradoMateria creado!!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gradoMateria = GradoMateria::find($id);
        return view("pedagogico.grado-materias.show", compact("gradoMateria"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gradoMateria = GradoMateria::find($id);
        $docentes = Docente::all();
        return view("pedagogico.grado-materias.edit", compact("gradoMateria", "docentes"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {   
        $docente_id = $request->docente;
        $gradoMateria = GradoMateria::find($id);
        
        $gradoMateria->docentes_id = $docente_id;
        $gradoMateria->update();
        return redirect()->route("gradosmaterias.index")->with("info", "GradoMateria con id: $id actualizado!!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gradoMateria = GradoMateria::find($id);
        $gradoMateriaId = $gradoMateria->id;

        $gradoMateria->delete();
        return redirect()->route("gradosmaterias.index")->with("info", "GradoMateria con id: $gradoMateriaId eliminado!!!");
    }

    public function createHorario(GradoMateria $gradoMateria) {
        $aulas = Aula::all();
        $dias = Dia::all();
        $horas = Hora::all();

        return view("pedagogico.grado-materias.horarios.create", compact("gradoMateria", "aulas", "dias", "horas"));
    }

    public function storeHorario(Request $request, GradoMateria $gradoMateria){


        $aula_nro = $request->aula;
        $dia_id = $request->dia;
        $hora_id = $request->hora;
        $gradoMateriaId = $gradoMateria->id;

        $request->validate([
            "aula" => ["required", new CreateHorarioForMateriaUniqueData($aula_nro, $dia_id, $hora_id) ],
            "dia" => ["required", new CreateHorarioForMateriaUniqueData($aula_nro, $dia_id, $hora_id) ],
            "hora" => ["required", new CreateHorarioForMateriaUniqueData($aula_nro, $dia_id, $hora_id) ],
        ]);
        
        $horario = new Horario();
        $horario->grados_materias_id = $gradoMateriaId;
        $horario->aulas_nro = $aula_nro;
        $horario->dias_id = $dia_id;
        $horario->horas_id = $hora_id;
        $horario->save();
        
        return redirect()->route("gradosmaterias.show", $gradoMateriaId)->with("info", "Nuevo horario agregado!!!");
    }
}
