@extends('templates.main')

@push('css_extend')
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
    <style>
        .distance-container {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
        }

        .distance-container > * {
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 11px;
            line-height: 18px;
            display: block;
            margin: 0;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>

    <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>

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


                <form class="forms-sample" action="/planmission/insert" method="POST" enctype="multipart/form-data">
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
                        <input type="hidden" class="form-control" name="features" id="features">
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

                    <div class="form-group">
                        <label for="exampleInputName1">Distance</label>
                        <input type="text" class="form-control @error('mission_flight') is-invalid @enderror"
                               placeholder="Mission Flight" name="distance" id="distance">
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

                    <a class="btn btn-primary" onclick="reset()">Reset</a>
                    <a class="btn btn-primary" onclick="print()">Print</a>
                    <div id="map"></div>
                    <div id="distance" class="distance-container"></div>

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
// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [115.188919, -8.409518],
            zoom: 10
        });

        const distanceContainer = document.getElementById('distance');

        // GeoJSON object to hold our measurement features
        let geojson = {
            'type': 'FeatureCollection',
            'features': []
        };

        // Used to draw a line between points
        const linestring = {
            'type': 'Feature',
            'geometry': {
                'type': 'LineString',
                'coordinates': []
            }
        };

        map.on('load', () => {
            map.addSource('geojson', {
                'type': 'geojson',
                'data': geojson
            });

// Add styles to the map
            map.addLayer({
                id: 'measure-points',
                type: 'circle',
                source: 'geojson',
                paint: {
                    'circle-radius': 5,
                    'circle-color': '#000'
                },
                filter: ['in', '$type', 'Point']
            });
            map.addLayer({
                id: 'measure-lines',
                type: 'line',
                source: 'geojson',
                layout: {
                    'line-cap': 'round',
                    'line-join': 'round'
                },
                paint: {
                    'line-color': '#ff0000',
                    'line-width': 3
                },
                filter: ['in', '$type', 'LineString']
            });

            map.on('click', (e) => {
                const features = map.queryRenderedFeatures(e.point, {
                    layers: ['measure-points']
                });

// Remove the linestring from the group
// so we can redraw it based on the points collection.
                if (geojson.features.length > 1) geojson.features.pop();

// Clear the distance container to populate it with a new value.
                distanceContainer.innerHTML = '';

// If a feature was clicked, remove it from the map.
                if (features.length) {
                    const id = features[0].properties.id;
                    geojson.features = geojson.features.filter(
                        (point) => point.properties.id !== id
                    );
                } else {
                    const point = {
                        'type': 'Feature',
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [e.lngLat.lng, e.lngLat.lat]
                        },
                        'properties': {
                            'id': String(new Date().getTime())
                        }
                    };

                    geojson.features.push(point);
                }

                if (geojson.features.length > 1) {
                    linestring.geometry.coordinates = geojson.features.map(
                        (point) => point.geometry.coordinates
                    );

                    geojson.features.push(linestring);

// Populate the distanceContainer with total distance
                    const value = document.createElement('pre');
                    const distance = turf.length(linestring);
                    const asu = document.getElementById('distance');
                    asu.value = `${distance.toLocaleString()} km`;

                    value.textContent = `Total distance: ${distance.toLocaleString()}km`;
                    distanceContainer.appendChild(value);
                }

                map.getSource('geojson').setData(geojson);
                document.getElementById("features").value = geojson;
            });
        });

        map.on('mousemove', (e) => {
            const features = map.queryRenderedFeatures(e.point, {
                layers: ['measure-points']
            });
// Change the cursor to a pointer when hovering over a point on the map.
// Otherwise cursor is a crosshair.
            map.getCanvas().style.cursor = features.length
                ? 'pointer'
                : 'crosshair';
        });


        function reset() {
            geojson = {
                'type': 'FeatureCollection',
                'features': []
            };
            map.getSource('geojson').setData(geojson);
            // console.log(geojson.features);
        }

        function print() {
            console.log(geojson.features);
        }
    </script>


@endsection
