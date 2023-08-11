<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAulaRequest;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::all();
        return view("pedagogico.aulas.index", compact("aulas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aulas = Aula::all();
        return view("pedagogico.aulas.create", compact("aulas"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAulaRequest $request)
    {
        Aula::create($request->all());
        return redirect()->route("aulas.index")->with("info", "Aula creado");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aula = Aula::find($id);
        return view("pedagogico.aulas.edit", compact("aula"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aula $aula)
    {
        $request->validate(
            [ "capacidad" => "required|numeric" ],
            
            [
                'capacidad.required' => 'El campo Capacidad es obligatorio.',
                'capacidad.numeric' => 'El campo Capacidad debe ser entero',
            ]
        );
        
        $aula->update($request->all());
        return redirect()->route("aulas.index")->with("info", "Aula actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aula = Aula::find($id);
        $nro = $aula->nro;
        $aula->delete();

        return redirect()->route("aulas.index")->with("info", "Nro: $nro, eliminado");
    }
}
