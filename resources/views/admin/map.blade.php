@extends('templates.main')

@push('css_extend')
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <style type="text/css">
        #mapid {
            height: 100%;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card-content collapse show">
                            <div class="card-body" style="height: 550px;">
                                <div id="mapid"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js'></script>
    <script
        src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2YWFkczIiLCJhIjoiY2xkYms3cWoyMDFkcTN2bnhvMHpkem0yeCJ9.ATwIXZyH200QMvg0Cb3EjA';
        var map = new mapboxgl.Map({
            container: 'mapid', // container id
            style: 'mapbox://styles/mapbox/streets-v11', // style URL
            center: [115.188919, -8.409518], // starting position [lng, lat]
            zoom: 8, // starting zoom
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function () {

            const el = document.createElement('div');
            el.className = 'marker';
            // el.style.backgroundImage = 'url(/assets/images/drone.png)';
            el.style.height = '30px';
            el.style.width = '30px';
            el.style.backgroundSize = '100%';

            const locations = <?php echo json_encode($project) ?>;

            locations.forEach(marker => {
                new mapboxgl.Marker()
                    .setLngLat([marker.longitude, marker.latitude])
                    .setPopup(
                        new mapboxgl.Popup({offset: 50}) // add popups
                            .setHTML(
                                '<p><b>' +
                                marker.drone_name +
                                '</b></p>' +
                                marker.mission_flight_name +
                                ''
                            )
                    )
                    .addTo(map);
            });
        });

    </script>

@endsection
