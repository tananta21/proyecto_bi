@extends('index')
@section('content')
<div class="col-lg-12 col-md-12">
    <div class="form-group" style="padding: 10px 10px; margin-bottom: 10px">
        <label style="padding-top: 10px; padding-left: 0rem; padding-right: 0rem" for="selectPais"
               class="col-sm-2 control-label">Seleccione una región</label>

        <div class="col-sm-2" style="padding-left: 0rem">
            <select class="form-control" id="selectPais">
                <option value="1" selected>PERÚ</option>
                <option value="2">BRAZIL</option>
                <option value="3">BOLIVIA</option>
                <option value="4">ECUADOR</option>
            </select>
        </div>
        <label style="padding-top: 10px; padding-left: 20px; padding-right: 0rem" for="selectPais"
               class="col-sm-2 control-label">Tipo de gráfico</label>

        <div class="col-sm-2" style="padding-left: 0rem">
            <select class="form-control" id="selectGraph">
                <option value="1">CANTIDAD(U)</option>
                <option value="2">PORCENTAJE(%)</option>
            </select>
        </div>
        <p class="p_numRegistros">Registros encontrados:<span id="numRegistros">Cargando...</span></p>
    </div>
    <div class="col-lg-12">
        <div id="container" style="min-width: 310px; height: 470px; margin: 0 auto"></div>
    </div>
</div>

@endsection

@section("js")
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script>

    function cantidadSismos(){
        $("#numRegistros").text('Cargando...')
        var url = '{{route("cantidad.sismos")}}';
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                pais_id: $("#selectPais").val()
            },
            dataType: 'JSON',
            beforeSend: function () {
            },
            error: function () {
            },
            success: function (datos) {
                console.log(datos[0][0].cant)
                $("#numRegistros").text(datos[0][0].cant+' Sismos')
            }
        });
    }

    $("#selectGraph").on('change', function () {
        window.onload = peticion();
    })
    $("#selectPais").on('change', function () {
        window.onload = peticion();
    })
    $(function () {
        window.onload = peticion();
    })
    function peticion() {
        window.onload = cantidadSismos();
        var url = '{{route("resumen.paises")}}';
        var tipoGrafico = $("#selectGraph").val();
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                pais_id: $("#selectPais").val(),
                tipo_graph: $("#selectGraph").val()
            },
            dataType: 'JSON',
            beforeSend: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%" "><div class="loader"></div><p style="font-weight: bold; text-align: center; padding-top: 15px">Cargando...</p></div>');
            },
            error: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%"> Ha surgido un error. </div>');
            },
            success: function (datos) {
                var data = datos;
                var circular = new Array();
                var barras = new Array();
                for (i = 0; i < data[0].length; i++) {
                    if (tipoGrafico == 2) {
                        circular.push(
                            {name: (data[0][i].name), y: parseFloat(data[0][i].y)}
                        );
                    }
                    else if(tipoGrafico == 1) {
                        barras.push(
                            {name: (data[0][i].name), y: parseFloat(data[0][i].y), drilldown: parseFloat(data[0][i].drilldown)}
                        );
                    }
                }
                if (tipoGrafico==2)
                {
                    Highcharts.chart('container', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'PORCENTAJE (%) DE SISMOS REGISTRADOS POR CATEGORÍA EN ' + $("#selectPais option:selected").text()
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [
                            {
                                name: 'Categoría',
                                colorByPoint: true,
                                data: circular
                            }
                        ]
                    });
                }
                else if(tipoGrafico == 1){
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'N° DE SISMOS REGISTRADOS POR CATEGORÍA EN'+ $("#selectPais option:selected").text()
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'Total percent market share'
                            }

                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> sismos registrados<br/>'
                        },

                        series: [{
                            name: 'Sismos',
                            colorByPoint: true,
                            data: barras
                        }]
                    });
                }
            }
        });
    }

</script>
@show