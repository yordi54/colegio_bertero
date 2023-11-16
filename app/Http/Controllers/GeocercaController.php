<?php

namespace App\Http\Controllers;

use App\Models\Geocerca;
use Illuminate\Http\Request;

class GeocercaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Geocerca::select("*")->cursorPaginate(5);
        return view("geocerca.create");
    }
}
