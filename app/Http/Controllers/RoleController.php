<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view("usuarios.roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("usuarios.roles.create");
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
        Role::create($request->all());
        return redirect()->route("roles.index")->with("info", "Role creado");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        return view("usuarios.roles.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);

        return view("usuarios.roles.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $request->validate(
            [
                "nombre" => "required|min:4"
            ],
            [
                "nombre.required" => "Este campo es requerido",
                "nombre.min" => "Ingrese al menos 4 caracteres"
            ]
        );
        $role->update($request->all());
        return redirect()->route("roles.index")->with("info", "Role $request->nombre actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $nombre = $role->nombre;
        $role->delete();
        return redirect()->route("roles.index")->with("info", "Role $nombre eliminado");
    }
}
