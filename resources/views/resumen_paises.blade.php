@extends('index')
@section('content')
<div>
    <div id="container"></div>
</div>
@endsection

@section("js")
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/south-america.js"></script>
<!--script resumen paises-->
<script>
    $(function () {
        window.onload = peticion();
    })
    function peticion() {
        var url = '{{route("resumen.paises")}}';
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
                var contenedor = new Array();
                var meses = new Array();
                var cont = 0;
                while (cont < datos[0].length) {
                    for (i=cont; i==cont; i++) {
                        meses.push((datos[0][i].code));
                        meses.push((datos[0][i].num_sismos));
                    }
                    contenedor.push(meses);
                    meses=[]
                    cont = cont+1;
                }
                var data = contenedor;
                // Create the chart
                Highcharts.mapChart('container', {
                    chart: {
                        map: 'custom/south-america'
                    },

                    title: {
                        text: 'Número de sismos de magnitud fuerte registrados en los países de Sudamérica'
                    },

                    subtitle: {
                        text: 'Registros de terremotos entre los 6 y 10.5 grados en la escala de Richter, desde 1970'
                    },

                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },

                    colorAxis: {
                        min: 0
                    },

                    series: [
                        {
                            data: data,
                            name: 'N° de sismos',
                            states: {
                                hover: {
                                    color: '#BADA55'
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    ]
                });


            }

        });
    }
</script>
@show