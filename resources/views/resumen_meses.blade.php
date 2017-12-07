@extends('index')
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="form-group" style="padding: 10px 10px; margin-bottom: 50px">
        <label style="padding-top: 10px; padding-left: 0rem; padding-right: 0rem" for="selectPais"
               class="col-sm-2 control-label">Seleccione un país</label>

        <div class="col-sm-4">
            <select class="form-control " id="selectPais">
                <option value="1" selected>PERÚ</option>
                <option value="2">BRAZIL</option>
                <option value="3">BOLIVIA</option>
                <option value="4">ECUADOR</option>
                <option value="5">COLOMBIA</option>
                <option value="6">URUGUAY</option>
                <option value="7">VENEZUELA</option>
                <option value="8">CHILE</option>
                <option value="9">PARAGUAY</option>
                <option value="10">ARGENTINA</option>
            </select>
        </div>
    </div>

    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
@endsection
@section('js')
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script>

    $("#selectPais").on('change', function () {
        window.onload = peticion();
    })

    $(function () {
        window.onload = peticion();
    })
    function peticion() {
        var url = '{{route("resumen.meses")}}';
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                pais_id: $("#selectPais").val()
            },
            dataType: 'JSON',
            beforeSend: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%" "><div class="loader"></div><p style="font-weight: bold; text-align: center; padding-top: 15px">Cargando...</p></div>');
            },
            error: function () {
                $("#container").html('<div style="position: absolute; top: 50%; left: 50%"> Ha surgido un error. </div>');
            },
            success: function (data) {
                var meses = new Array();
                var num_sismos = new Array();
                for (i = 0; i < data[0].length; i++) {
                    meses.push((data[0][i].mes).substring(0, 3));
                    num_sismos.push((data[0][i].num_sismos));
                }
                window.onload = graficar(meses, num_sismos);
            }
        });
    }

    function graficar(meses, num_sismos) {
        Highcharts.chart('container', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Número de sismos registrados al mes en ' + $("#selectPais option:selected").text()
            },
            subtitle: {
                text: 'Registros tomados desde el año 1970'
            },
            xAxis: {
                categories: meses
            },
            yAxis: {
                title: {
                    text: 'N° de Sismos registrados'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [
                {
                    name: 'N° Sismos',
                    marker: {
                        symbol: 'square'
                    },
                    data: num_sismos

                }
            ]
        });
    }

</script>
@show
