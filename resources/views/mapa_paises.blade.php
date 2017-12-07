@extends('index')
@section('content')
<div>
    <div>
        <h3 class="mapaContainer__tittle">Sismos registrados en Sudamérica desde el año 1970</h3>
    </div>
    <div class="form-group" style="padding: 10px 10px; margin-bottom: 0px">
        <label style="padding-top: 10px; padding-left: 0rem; padding-right: 0rem" for="selectPais" class="col-sm-2 control-label">Seleccione una región</label>
        <div class="col-sm-2" style="padding-left: 0rem">
            <select class="form-control" id="selectPais">
                <option value="15">SUDAMÉRICA</option>
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
        <label style="padding-top: 10px; padding-left: 20px; padding-right: 0rem" for="selectPais" class="col-sm-2 control-label">Seleccione Categoría</label>
        <div class="col-sm-2" style="padding-left: 0rem">
            <select class="form-control"  id="selectIntensidad">
                <option value="15" selected>TODOS</option>
                <option value="1">MICROSISMO</option>
                <option value="2">MENOR</option>
                <option value="3">LIGERO</option>
                <option value="4">MODERADO</option>
                <option value="5">FUERTE</option>
                <option value="6">MAYOR</option>
                <option value="7">GRANDE</option>
                <option value="8">LEGENDARIO</option>
            </select>
        </div>
        <p class="p_numRegistros">Registros encontrados:<span id="numRegistros">Cargando...</span></p>
    </div>
    <div class="mapaContainer" id="mapCanvas"></div>
    <div class="boxLeyenda">
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">MICROSISMO</p>
            <hr style="background:#33FFFF " class="boxLeyenda__hr"/>
        </div>
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">MENOR</p>
            <hr style="background:#33FFB2 " class="boxLeyenda__hr"/>
        </div>
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">LIGERO</p>
            <hr style="background:#E6FF33 " class="boxLeyenda__hr"/>
        </div>
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">MODERADO</p>
            <hr style="background:#FFCA33" class="boxLeyenda__hr"/>
        </div>
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">FUERTE</p>
            <hr style="background:#CD6E1E" class="boxLeyenda__hr"/>
        </div>
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">MAYOR</p>
            <hr style="background:#CD231E" class="boxLeyenda__hr"/>
        </div>
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">GRANDE</p>
            <hr style="background:#2B1ECD" class="boxLeyenda__hr"/>
        </div>
        <div class="boxLeyenda__item">
            <p class="boxLeyenda__title">LEGENDARIO</p>
            <hr style="background:#CD1E6B" class="boxLeyenda__hr"/>
        </div>
    </div>
</div>

@endsection

@section("js")
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-DYMAoSHPoQ-fX4wwZ6xG0d2A0TWUnYQ"></script>
<script type="text/javascript">
    $("#selectPais").on('change', function() {
        $("#numRegistros").text('Cargando...')
        window.onload = initMap();
    })
    $("#selectIntensidad").on('change', function() {
        $("#numRegistros").text('Cargando...')
        window.onload = initMap();
    })

    function initMap() {
        var url = '{{route("mapa.paises")}}';
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                pais_id: $("#selectPais").val(),
                intensidad_id: $("#selectIntensidad").val()
            },
            dataType: 'JSON',
            beforeSend: function () {
                $("#mapCanvas").html('<div style="position: absolute; top: 45%; left: 45%" "><div class="loader"></div><p style="font-weight: bold; text-align: center; padding-top: 15px">Cargando...</p></div>');
            },
            error: function () {
                $("#mapCanvas").html('<div style="position: absolute; top: 50%; left: 50%"> Ha surgido un error. </div>');
            },
            success: function (datos) {
                var contenedor = new Array();
                var meses = new Array();
                var cont = 0;
                while (cont < datos[0].length) {
                    for (i=cont; i==cont; i++) {
                        meses.push((datos[0][i].region));
                        meses.push((datos[0][i].lat));
                        meses.push((datos[0][i].lon));
                        meses.push((datos[0][i].mag));
                        meses.push(
                            '<div class="info_content">'+
                                '<h3><strong>'+datos[0][i].region+'</strong></h3>'+
                                '<p>Magnitud Sismo:<span style="padding-left: 10px"><strong>'+(datos[0][i].mag)+' escala de Richter</strong></span></p>' +
                                '<p>Profundidad:<span style="padding-left: 10px"><strong>'+(datos[0][i].profundidad)+' kilómetros</strong></span></p>' +
                                '<p><a style="cursor: pointer" data-toggle="modal" data-target="#detalleSisModal"  data-sismo-id="'+datos[0][i].id+'">Ver más..</a></p>' +
                                '</div>');
                        meses.push((datos[0][i].inten_color));
                    }
                    contenedor.push(meses);
                    meses=[]
                    cont = cont+1;
                }
                console.log(datos)
//                console.log(contenedor)
                $("#numRegistros").text(contenedor.length+' Sismos')
                if(contenedor.length !=0){
                var map;
                var bounds = new google.maps.LatLngBounds();
                var mapOptions = {
                    mapTypeId: 'roadmap'

                };

                // Display a map on the web page
                map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
                map.setTilt(50);
//        Multiple markers location, latitude, and longitude
//        var markers = [
//            ['Brooklyn Museum, NY', -16.3, -73.56],
//            ['Brooklyn Public Library, NY',-19.63, -70.86],
//            ['Prospect Park Zoo, NY',-13.38,-76.56]
//        ];

                var markers = contenedor;
                var infoWindowContent = contenedor;

                // Add multiple markers to map
                var infoWindow = new google.maps.InfoWindow(), marker, i;

                // Place each marker on the map
                for( i = 0; i < markers.length; i++ ) {
                    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                    bounds.extend(position);
                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: markers[i][0],
                        icon: 'http://www.googlemapsmarkers.com/v1/'+ markers[i][5]+'/'
//                url: "https://www.google.com.pe",
//                id:2
                    });

                    // Add info window to marker
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
//                    console.log(this.id);
//                    window.location.href = this.url;
                            infoWindow.setContent(infoWindowContent[i][4]);
                            infoWindow.open(map, marker);
                        }
                    })(marker, i));

                    // Center the map to fit all markers on the screen
                    map.fitBounds(bounds);
                }

                // Set zoom level
                var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                    this.setZoom(3);
                    google.maps.event.removeListener(boundsListener);
                });
            }
                else{
                    $("#mapCanvas").html('<div style="position: absolute; top: 40%; left: 35%">' +
                        '<h3><strong>No se encontraron resultados</strong></h1></div>');
                }
            }

        });
    }
    // Load initialize function

    google.maps.event.addDomListener(window, 'load', initMap);

</script>
<script type="text/javascript">
    var detalle_sismo = $("#detalleSisModal");
    detalle_sismo.on('shown.bs.modal', function (e) {
        var sismo_id = $(e.relatedTarget).data('sismo-id');
        var url = '{{route("detalle.sismo")}}';
        var load = $("#loadingDetalle");
        var error = $("#errorDetalle");
        var content = $("#contentDetalle");
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                sismo_id: sismo_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                load.css("display","block");
            },
            error: function () {
                load.css("display","none");
                error.css("display","block");
            },
            success: function (datos) {
                load.css("display","none");
                content.css("display","block");

                $("#sis_pais").text(datos[0][0].nombre);
                $("#sis_region").text(datos[0][0].region);
                $("#sis_lat").text(datos[0][0].lat);
                $("#sis_lon").text(datos[0][0].lon);
                $("#sis_mag").text(datos[0][0].mag);
                $("#sis_fecha").text(datos[0][0].fecha_sismo);
                $("#sis_cat").text(datos[0][0].inten_name);
                $("#sis_profun").text(datos[0][0].profundidad);

                var lat= $("#sis_lat").text();
                var lon= $("#sis_lon").text();

                window.onload = initMap(parseFloat(lat),parseFloat(lon));
                function initMap(lat,lon) {
                    var myLatLng = {lat: lat, lng: lon};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 7,
                        center: myLatLng,
                        mapTypeId: 'satellite'
                    });
                    map.setMapTypeId('terrain');

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: 'Epicentro del sismo!'
                    });
                }





            }

        });


    });
    detalle_sismo.on('hidden.bs.modal', function () {
        $("#contentDetalle").css("display","none");
    })

</script>

<!--<script type="text/javascript">-->
<!---->
<!--    function initMap() {-->
<!--        var myLatLng = {lat: -25.363, lng: 131.044};-->
<!---->
<!--        var map = new google.maps.Map(document.getElementById('map'), {-->
<!--            zoom: 10,-->
<!--            center: myLatLng-->
<!--        });-->
<!---->
<!--        var marker = new google.maps.Marker({-->
<!--            position: myLatLng,-->
<!--            map: map,-->
<!--            title: 'Hello World!'-->
<!--        });-->
<!--    }-->
<!--    google.maps.event.addDomListener(window, 'load', initMap);-->
<!--</script>-->
@show