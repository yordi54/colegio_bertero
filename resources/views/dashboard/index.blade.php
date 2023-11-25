@extends('layout')

@section('content')
<style>
    .card{
        border-radius: 10px;
        /** sombreado */
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        /**color de fondo*/
    }
    .card-title{
        text-align: center;
        font-size: 2em; /* Increase the icon size */
        /*color*/
        color: white;

    }
    .card-statistic {
        display: flex;
        justify-content :space-between;
    }

    .icon-wrapper {
        margin-right: 10px;
    }

    .card-statistic-icon {
      
        font-size: 2em; /* Increase the icon size */
        color: white;
    }

    .card-statistic-value {
        margin-left: 10px;
        font-size: 1em; /* Increase the icon size */
        color: white;
    }

</style>
<div class="container p-0" >
    <div class="cards p-5">
        <div class="row">
            <div class="col">
                <div class="card mb-3 bg-success" >
                    <div class="card-header">
                        <h3 class="card-title" >Faltas x Mes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="card-statistic-icon"><i class="bi bi-person"></i></div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="card-statistic-value"><strong>Docente:</strong>  {{ $faltasDocMes["nombreCompleto"] }}</div>
                                </div>
                                <div class="row">
                                    <div class="card-statistic-value"><strong>Faltas:</strong> {{ $faltasDocMes["totalFaltas"] }}</div>
                                </div>
                            </div>
                            
        
                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="card mb-3 bg-danger" >
                    <div class="card-header">
                        <h3 class="card-title" >Asistencias x Mes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="card-statistic-icon"><i class="bi bi-person"></i></div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="card-statistic-value"><strong>Docente:</strong>  {{ $asistenciaDocMes["nombreCompleto"] }}</div>
                                </div>
                                <div class="row">
                                    <div class="card-statistic-value"><strong>AsistenciasSinRetraso:</strong> {{$asistenciaDocMes["asistenciasSinRetraso"]}} </div>
                                </div>
                            </div>
                            
        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 bg-primary" >
                    <div class="card-header">
                        <h3 class="card-title" >Licencias x Mes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="card-statistic-icon"><i class="bi bi-person"></i></div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="card-statistic-value"><strong>Docente:</strong>  {{ $licenciaDocMes["nombreCompleto"] }}</div>
                                </div>
                                <div class="row">
                                    <div class="card-statistic-value"><strong>Licencias:</strong> {{ $licenciaDocMes["totalLicencias"] }} </div>
                                </div>
                            </div>
                            
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class= "charts pt-3 pb-3 ps-5 pe-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary" style="--bs-bg-opacity: .7;">
                        <h3 class="card-title" >Comparativa Anual de Asistencias, Licencias y Faltas</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="100"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class= "charts pt-3 pb-3 ps-5 pe-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary" style="--bs-bg-opacity: .7;">
                        <h3 class="card-title" >Comparación Anual de Asistencias: Retraso vs Sin Retraso   </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2" height="100"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class= "charts pt-3 pb-3 ps-5 pe-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary" style="--bs-bg-opacity: .7;">
                        <h3 class="card-title" >Distribución de Asistencias, Faltas y Licencias x Mes</h3>
                    </div>
                    <div class="card-body  mx-auto d-flex align-items-center" style="max-width: 500px;">
                        <canvas id="myChart3" ></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    var asistencias = @json($asistencias); 
    var faltas = @json($faltas);
    var licencias = @json($licencias);
    var distribucionGeneral = @json($distribucionGeneral);
    var asistenciaConRetraso = @json($asistenciaConRetraso);
    var asistenciaSinRetraso = @json($asistenciaSinRetraso);
    console.log(asistenciaConRetraso);
    console.log(asistenciaSinRetraso);
    const ctx = document.getElementById('myChart');
    const ctx2 = document.getElementById('myChart2');
    const ctx3 = document.getElementById('myChart3');
    const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiempre', 'Octubre', 'Noviembre', 'Diciembre'];
    const data = {
        labels: labels,
        datasets: [{
            type: 'line',
            label: 'Asistencias',
            data: asistencias,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        },
        {
            type: 'line',
            label: 'Licencias',
            data: licencias,
            fill: false,
            borderColor: 'rgb(255, 99, 132)',
            tension: 0.1
        },
        {
            type: 'line',
            label: 'Faltas',
            data: faltas,
            fill: false,
            borderColor: 'rgb(115, 79, 132)',
            tension: 0.1
        },
    ]
    };
    new Chart(ctx, {
        type: 'scatter',
        data: data,
        options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
        }
    });

    new Chart(ctx2, {
        type: 'scatter',
        data: {
            labels: labels,
            datasets: [{
                type: 'bar',
                label: 'Asistencias sin Retraso',
                data: asistenciaSinRetraso,
                borderWidth: 1
            },
            {
                type: 'bar',
                label: 'Asistencias con Retraso',
                data: asistenciaConRetraso,
                borderWidth: 1
            },
        ]
        },
        options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
        }
    });
    var data2 = {
        labels: ['Asistencias', 'Faltas', 'Licencias'],
        datasets: [{
            data: distribucionGeneral, // Porcentajes correspondientes
            backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'] // Colores para cada categoría
        }]
    };

    new Chart(ctx3, {
        type: 'doughnut',
        data: data2,
        options: {
            title: {
            display: true,
            text: 'Distribución de Asistencias, Faltas y Licencias'
            },
            legend: {
            display: true,
            position: 'bottom'
            }
        }
    });
</script>
@endsection