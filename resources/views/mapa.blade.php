@extends('index')
@section('content')
<div>
    <h1>aquí se trabajara con el api de google maps</h1>
    <div id="container">

    </div>
</div>
@endsection

@section("js")
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/south-america.js"></script>
<script>
    // Prepare demo data
    // Data is joined to map using value of 'hc-key' property by default.
    // See API docs for 'joinBy' for more info on linking data and map.
    var data = [
        ['br', 0],
        ['ec', 1],
        ['ve', 2],
        ['cl', 3],
        ['ar', 4],
        ['pe', 5],
        ['uy', 6],
        ['py', 7],
        ['bo', 8],
        ['sr', 9],
        ['gy', 10],
        ['gb', 11],
        ['co', 12]
    ];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: 'custom/south-america'
        },

        title: {
            text: 'Highmaps basic demo'
        },

        subtitle: {
            text: 'Source map: <a href="http://code.highcharts.com/mapdata/custom/south-america.js">South America</a>'
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

        series: [{
            data: data,
            name: 'Random data',
            states: {
                hover: {
                    color: '#BADA55'
                }
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }]
    });
</script>
@show