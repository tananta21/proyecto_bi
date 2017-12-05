@extends('index')
@section('content')
<div class="col-lg-12 col-md-12">
    <div class="form-group" style="padding: 10px 10px; margin-bottom: 35px">
        <label style="padding-top: 10px; padding-left: 0rem; padding-right: 0rem" for="selectPais"
               class="col-sm-2 control-label">Seleccione una región</label>
        <div class="col-sm-4" style="padding-left: 0rem">
            <select class="form-control" id="selectPais">
                <option value="15">SUDAMÉRICA</option>
                <option value="1" selected>PERÚ</option>
                <option value="2">BRAZIL</option>
                <option value="3">BOLIVIA</option>
                <option value="4">ECUADOR</option>
            </select>
        </div>
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
    $("#selectPais").on('change', function () {
        window.onload = peticion();
    })
    $(function () {
        window.onload = peticion();
    })
    function peticion() {
        var url = '{{route("categoria.sismos")}}';
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                pais_id: $("#selectPais").val()
            },
            dataType: 'JSON',
            beforeSend: function () {
//                $("#container").html('<div style="position: absolute; top: 50%; left: 50%" "><div class="loader"></div><p style="font-weight: bold; text-align: center; padding-top: 15px">Cargando...</p></div>');
            },
            error: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%"> Ha surgido un error. </div>');
            },
            success: function (datos) {
                var data = datos;
                var categorias = new Array();
                for (i = 0; i < data[0].length; i++) {
                    categorias.push(
//                        {name:(data[0][i].name), y:parseFloat(data[0][i].y), drilldown:(data[0][i].drilldown)}
                        {name:(data[0][i].name), y:parseFloat(data[0][i].y)}
                    );
                }
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
                    series: [{
                        name: 'Categoría',
                        colorByPoint: true,
                        data: categorias
                    }]
                });
            }
        });
    }

</script>
@show