@extends('templates.main')

@push('css_extend')
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
    <style>
        .calculation-box {
            height: 90px;
            width: 150px;
            position: absolute;
            bottom: 40px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            text-align: center;
        }

        p {
            font-family: 'Open Sans';
            margin: 0;
            font-size: 13px;
        }
    </style>

    <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.4.0/mapbox-gl-draw.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.4.0/mapbox-gl-draw.css" type="text/css">
    <style type="text/css">
        #map {
            height: 600px;
        }
    </style>
@endpush

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">TEST</h4>


                <form class="forms-sample" action="/project/insert" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col">
                            <label>Start Date</label>
                            <div id="the-basics">
                                <input class="typeahead @error('start_date') is-invalid @enderror" type="date"
                                       name="start_date">
                                <div class="invalid-feedback">
                                    @error('start_date')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label>Until Date</label>
                            <div id="bloodhound">
                                <input class="typeahead @error('until_date') is-invalid @enderror" type="date"
                                       name="until_date">
                                <div class="invalid-feedback">
                                    @error('until_date')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Mission Flight</label>
                        <input type="text" class="form-control @error('mission_flight') is-invalid @enderror"
                               placeholder="Mission Flight" name="mission_flight" value="{{ old('mission_flight') }}">
                        <div class="invalid-feedback">
                            @error('mission_flight')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    @error('latitude')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror


                    <div id="map"></div>
                    <div class="calculation-box">
                        <p>Click the map to draw a polygon.</p>
                        <div id="calculated-area"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg text-light">Submit</button>
                    <a href="/project" class="btn btn-danger btn-lg text-light">Cancel</a>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2YWFkczIiLCJhIjoiY2xkYms3cWoyMDFkcTN2bnhvMHpkem0yeCJ9.ATwIXZyH200QMvg0Cb3EjA';
        const map = new mapboxgl.Map({
            container: 'map',
            // style: 'mapbox://styles/mapbox/streets-v11',
            style: 'mapbox://styles/mapbox/satellite-v9',
            center: [115.188919, -8.409518],
            zoom: 9,
        });

        // const geocoder = new MapboxGeocoder({
        //     accessToken: mapboxgl.accessToken,
        //     mapboxgl: mapboxgl,
        //     marker: false,
        //     placeholder: 'Enter the place....',
        //     zoom: 20
        // });
        //
        // map.addControl(
        //     geocoder
        // );

        const draw = new MapboxDraw({
            displayControlsDefault: false,
// Select which mapbox-gl-draw control buttons to add to the map.
            controls: {
                polygon: true,
                trash: true
            },
// Set mapbox-gl-draw to draw by default.
// The user does not have to click the polygon control button first.
            defaultMode: 'draw_polygon'
        });
        map.addControl(draw);

        map.on('draw.create', updateArea);
        map.on('draw.delete', updateArea);
        map.on('draw.update', updateArea);

        function updateArea(e) {
            const data = draw.getAll();
            console.log(data);
//             const answer = document.getElementById('calculated-area');
//             if (data.features.length > 0) {
//                 const area = turf.area(data);
// // Restrict the area to 2 decimal points.
//                 const rounded_area = Math.round(area * 100) / 100;
//                 answer.innerHTML = `<p><strong>${rounded_area}</strong></p><p>square meters</p>`;
//             } else {
//                 answer.innerHTML = '';
//                 if (e.type !== 'draw.delete')
//                     alert('Click the map to draw a polygon.');
//             }
        }

    </script>


@endsection
