<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    public function index(){
        $mesActual = date('n');

        $data_asistencia = Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/asistencia/by-mes');
        $data_falta = Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/falta/by-mes');
        $data_licencia = Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/licencia/by-mes');
        $faltasDocMes= Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/falta/docente-mas-faltas');
        $asistenciasDocMes = Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/asistencia/docente-mas-asistencias');
        $licenciasDocMes = Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/licencia/docente-mas-licencias');
        // Inicializar $asistencias con ceros para todos los meses hasta el actual
        $distribucionGeneral = Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/asistencia/distribucion-general');  
        $dataComparativaAsistencia = Http::get('https://colegio-bi-microservicio.azurewebsites.net/api/asistencia/comparativa-asistencias');
        $asistencias = array_fill(1, $mesActual, 0);
        $faltas = array_fill(1, $mesActual, 0);
        $licencias = array_fill(1, $mesActual,0 );
        $asistenciaSinRetraso = array_fill(1, $mesActual,0 );
        $asistenciaConRetraso = array_fill(1, $mesActual,0 );
        if($data_asistencia->ok()){
            $data = $data_asistencia->json();
            // Llenar $asistencias con datos reales de la API
            foreach ($data as $item) {
                $mes = $item['mes'];
                $total = $item['total'];
                $asistencias[$mes] = $total;
            }
        }
        if($data_falta->ok()){
            $data = $data_falta->json();
            // Llenar $asistencias con datos reales de la API
            foreach ($data as $item) {
                $mes = $item['mes'];
                $total = $item['total'];
                $faltas[$mes] = $total;
            }
        }
        if($data_licencia->ok()){
            $data = $data_licencia->json();
            // Llenar $asistencias con datos reales de la API
            foreach ($data as $item) {
                $mes = $item['mes'];
                $total = $item['total'];
                $licencias[$mes] = $total;
            }
        }
        if($faltasDocMes->ok()){
            $falltaDocMes = $faltasDocMes->json();
        }
        if($asistenciasDocMes->ok()){
            $asistenciaDocMes = $asistenciasDocMes->json();
        }
        if($licenciasDocMes->ok()){
            $licenciaDocMes = $licenciasDocMes->json();
        }
        if($distribucionGeneral->ok()){
            $distribucionGeneral = $distribucionGeneral->json();
        }
        if($dataComparativaAsistencia->ok()){
            $data = $dataComparativaAsistencia->json();
            // Llenar $asistencias con datos reales de la API
            foreach ($data as $item) {
                $mes = $item['mes'];
                $asistenciaConRetraso[$mes] = $item['asistenciasConRetraso'];
                $asistenciaSinRetraso[$mes] = $item['asistenciasSinRetraso'];
                
            }
        }

        $faltas = array_values($faltas); // Reindexar numéricamente
        $licencias = array_values($licencias);
        $asistencias = array_values($asistencias); // Reindexar numéricamente
        $distribucionGeneral = array_values($distribucionGeneral);
        $asistenciaConRetraso = array_values($asistenciaConRetraso);
        $asistenciaSinRetraso = array_values($asistenciaSinRetraso);
        return view('dashboard.index', [
            'asistencias' => $asistencias, 
            'faltas' => $faltas, 
            'licencias' => $licencias, 
            'faltasDocMes' => $faltasDocMes,
            'asistenciaDocMes' => $asistenciaDocMes,
            'licenciaDocMes' => $licenciaDocMes,
            'distribucionGeneral' => $distribucionGeneral,
            'asistenciaConRetraso' => $asistenciaConRetraso,
            'asistenciaSinRetraso' => $asistenciaSinRetraso,
        ]);
    }
}
