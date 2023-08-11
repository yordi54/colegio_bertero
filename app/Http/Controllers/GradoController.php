<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grados = Grado::all();
        return view("pedagogico.grados.index", compact("grados"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pedagogico.grados.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "nombre" => "required|min:4"
            ],
            [
                "nombre.required" => "Este campo es requerido",
                "nombre.min" => "Ingrese al menos 4 caracteres"
            ]
        );
        Grado::create($request->all());
        return redirect()->route("grados.index")->with("info", "Grado creado");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grado = Grado::find($id);

        return view("pedagogico.grados.show", compact("grado"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $grado = Grado::find($id);

        return view("pedagogico.grados.edit", compact("grado"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grado $grado)
    {
        $request->validate(
            [
                "nombre" => "required|min:4"
            ],
            [
                "nombre.required" => "Este campo es requerido",
                "nombre.min" => "Ingrese al menos 4 caracteres"
            ]
        );
        $grado->update($request->all());
        return redirect()->route("grados.index")->with("info", "Grado actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grado = Grado::find($id);
        $id = $grado->id;
        $grado->delete();
        return redirect()->route("grados.index")->with("info", "Grado con id: $id eliminado");
    }
}
