@extends('index')
@section('content')
<div class="col-lg-12 col-md-12">
    <div class="form-group" style="padding: 10px 10px; margin-bottom: 10px">
        <label style="padding-top: 10px; padding-left: 0rem; padding-right: 0rem" for="selectPais"
               class="col-sm-2 control-label">Seleccione país</label>

        <div class="col-sm-2" style="padding-left: 0rem">
            <select class="form-control" id="selectPais">
                <option value="1" selected>PERÚ</option>
                <option value="2">BRAZIL</option>
                <option value="3">BOLIVIA</option>
                <option value="4">ECUADOR</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" onclick="javascript:historialAños();return false;">Consultar</button>
    </div>
    <div class="col-lg-12">
        <div id="container" style="min-width: 310px; height: 470px; margin: 0 auto">
        </div>
    </div>
</div>

@endsection

@section("js")
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
    var pruebita = new Array();
    var contador = 0;

    function categoria(years) {
        var url = '{{route("lista.categoria")}}';
        $.ajax({
            type: 'GET',
            url: url,
            data: {},
            dataType: 'JSON',

            error: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%"> Ha surgido un error. </div>');
            },
            success: function (cat) {
                var cadena = new Array();
                var grafico = [];
                var num = 0;
                for (n = 0; n < cat[0].length; n++) {
                    var url = '{{route("historial.by_ano")}}';
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            cat: cat[0][n].id,
                            pais: $("#selectPais").val()
                        },
                        beforeSend: function () {
                            $("#container").html('<div style="position: absolute; top: 50%; left: 50%" "><div class="loader"></div><p style="font-weight: bold; text-align: center; padding-top: 15px">Cargando...</p></div>');
                        },
                        dataType: 'JSON',

                        error: function () {
                            $("#container").html('<div style="position: absolute; top: 50%; left: 50%"> Ha surgido un error. </div>');
                        },
                        success: function (datos) {
                            var con = 0
                            var con2 = 0
                            if (datos[0].length != 0) {
                                for (j = 0; j < years[0].length; j++) {
                                    for (i = 0; i < datos[0].length; i++) {
                                        if (datos[0][i].ano == years[0][j].ano) {
                                            cadena.push(parseFloat(datos[0][i].cant))
                                            con = con + 1;
                                        }
                                    }
                                    if (con == con2) {
                                        cadena.push(parseFloat(0))
                                        con = con + 1;
                                        con2 = con2 + 1;
                                    }
                                    else {
                                        con2 = con2 + 1;
                                    }
                                }
                                window.onload = prueba(cadena, cat[0][num].descripcion);
                            }
                            else {
                                cadena=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
                                window.onload = prueba(cadena, cat[0][num].descripcion);
                            }

                    num = num + 1;
                    cadena = []
                }
            });

    }
    }
    })
    ;
    }

    function prueba(cadena, descrip) {

        contador = contador + 1;
        pruebita.push({
            name: descrip, data: cadena
        })
        if (contador == 7) {
            console.log("kev")
            window.onload = grafi(pruebita);
        }
    }
    function grafi(datos) {
        Highcharts.chart('container', {

            title: {
                text: 'Registro de sismos por categoria desde el año 1970 en' + $("#selectPais option:selected").text()
            },

            subtitle: {
                text: ''
            },

            yAxis: {
                title: {
                    text: 'Number of Employees'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 1970
                }
            },

            series: datos,

            responsive: {
                rules: [
                    {
                        condition: {
                            maxWidth: 10500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }
                ]
            }

        });
    }
    function historialAños() {
        var url = '{{route("historial.anos")}}';
        $.ajax({
            type: 'GET',
            url: url,
            data: {},
            dataType: 'JSON',
            beforeSend: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%" "><div class="loader"></div><p style="font-weight: bold; text-align: center; padding-top: 15px">Cargando...</p></div>');
            },
            error: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%"> Ha surgido un error. </div>');
            },
            success: function (datos) {
                window.onload = categoria(datos);
            }
        });
    }

    $(function () {
        window.onload = historialAños();
    })


</script>
@show