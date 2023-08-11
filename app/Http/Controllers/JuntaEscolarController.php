<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJEscolarRequest;
use App\Models\Grado;
use App\Models\JuntaEscolar;
use App\Models\JuntaEscolarGrado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JuntaEscolarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juntaEscolar = JuntaEscolar::select("*")->cursorPaginate(5);
        return view('usuarios.junta-escolar.index', compact('juntaEscolar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grados = Grado::all();
        $roles = [ "Delegado/a", "Presidente", "Vicepresidente", "Tesorero/a", "Secretario/a" ];
        
        return view("usuarios.junta-escolar.create", compact("grados", "roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJEscolarRequest $request)
    {
        $juntaEscolar = $request->all();
        $juntaEscolar['estado_activo'] = ($juntaEscolar['estado_activo'] == '1') ? true : false;

        //Insertando junta escolar
        $juntaEscolarCreated = JuntaEscolar::create($juntaEscolar);

        //Insertando junta_grados
        $juntas_id = $juntaEscolarCreated->id;
        $grados_id = $request->grado;
        $fechaActual = Carbon::now();

        $juntaGrado = new JuntaEscolarGrado();
        $juntaGrado->junta_escolar_id = $juntas_id;
        $juntaGrado->grados_id = $grados_id;
        $juntaGrado->fecha_asignacion = $fechaActual;
        $juntaGrado->save();

        return redirect()->route("juntas.index")->with("info", "$juntaEscolarCreated->nombres $juntaEscolarCreated->apellidos creado!!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $juntaEscolar = JuntaEscolar::find($id);
        $grados = $juntaEscolar->grados;
        return view('usuarios.junta-escolar.show', compact('juntaEscolar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $juntaEscolar = JuntaEscolar::find($id);
        return view("usuarios.junta-escolar.edit", compact("juntaEscolar"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJEscolarRequest $request, string $id)
    {
        $juntaEscolar = JuntaEscolar::find($id);
        $juntaEscolar->update($request->all());
        return redirect()->route("juntas.index")->with("info", "$juntaEscolar->nombres $juntaEscolar->apellidos actualizado!!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $juntaEscolar = JuntaEscolar::find($id);

        $names = "$juntaEscolar->nombres $juntaEscolar->apellidos";
        $juntaEscolar->delete();
        return redirect()->route("juntas.index")->with("info", "$names eliminado!!!");
    }

    public function buscar(Request $request)
    {
        $searchTerm = $request->input('query');       
        $usuarios = JuntaEscolar::where('nombres', 'LIKE', "%$searchTerm%")
                        ->orWhere('apellidos', 'LIKE', "%$searchTerm%")
                        ->get();
        return response()->json($usuarios);
    }
}
