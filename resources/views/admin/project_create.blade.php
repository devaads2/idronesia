@extends('templates.main')

@push('css_extend')
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <link rel="stylesheet"
          href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
          type="text/css">
    <script
        src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
@endpush

@section('content')


    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>


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

                    <div class="form-group row">
                        <div class="col-10">
                            <label for="exampleInputName1">Select Mission Flight</label>
                            <select class="form-select form-select-sm @error('id_mission_flight') is-invalid @enderror"
                                    name="id_mission_flight">
                                <option value="">----- SELECT MISSION FLIGHT -----</option>
                                @foreach ($missionflight as $mission)
                                    <option value="{{ $mission->mission_flight_id }}">{{ $mission->mission_flight_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                @error('id_mission_flight')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-2"><a href="/datamaster/missionflight" class="btn btn-block btn-primary text-white vcenter-item" style="height: 60px; width: 100px"
                                              id="newMissionBtn">Add New Mission Flight</a></div>
                    </div>

                    @error('latitude')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror


                    <div id="map"></div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="latitude" id="latitude">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="longitude" id="longitude">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="full_address" id="full_address">
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Select Manager</label>
                                <select class="form-select form-select-sm @error('id_manager') is-invalid @enderror"
                                        name="id_manager">
                                    <option value="">----- SELECT MANAGER -----</option>
                                    @foreach ($manager as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('id_manager')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Select Pilot</label>
                                <select class="form-select form-select-sm @error('id_pilot') is-invalid @enderror"
                                        name="id_pilot">
                                    <option value="">----- SELECT Pilot -----</option>
                                    @foreach ($pilot as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('id_pilot')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Select Drone</label>
                                <select class="form-select form-select-sm @error('id_drone') is-invalid @enderror"
                                        name="id_drone">
                                    <option value="">----- SELECT DRONE -----</option>
                                    @foreach ($drone as $d)
                                        <option value="{{ $d->id }}">{{ $d->drone_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('id_drone')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Select Battries</label>
                                <select class="form-select form-select-sm @error('id_batteries') is-invalid @enderror"
                                        name="id_batteries">
                                    <option value="">----- SELECT BATTERIES -----</option>
                                    @foreach ($batteries as $b)
                                        <option value="{{ $b->id }}">{{ $b->batteries_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('id_batteries')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Select Equipments</label>
                                <select class="form-select form-select-sm @error('id_equipments') is-invalid @enderror"
                                        name="id_equipments">
                                    <option value="">----- SELECT EQUIPMENTS -----</option>
                                    @foreach ($equipments as $e)
                                        <option value="{{ $e->id }}">{{ $e->equipments_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('id_equipments')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Select Kits</label>
                                <select class="form-select form-select-sm @error('id_kits') is-invalid @enderror"
                                        name="id_kits">
                                    <option value="">----- SELECT KITS -----</option>
                                    @foreach ($kits as $k)
                                        <option value="{{ $k->id }}">{{ $k->kits_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('id_kits')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
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
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [115.188919, -8.409518],
            zoom: 9,
        });

        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: false,
            placeholder: 'Enter the place....',
            zoom: 20
        });

        map.addControl(
            geocoder
        );

        let marker = null
        map.on('click', function (e) {
            if (marker == null) {
                marker = new mapboxgl.Marker()
                    .setLngLat(e.lngLat)
                    .addTo(map);
            } else {
                marker.setLngLat(e.lngLat)
            }
            lk = e.lngLat
            document.getElementById("latitude").value = e.lngLat.lat;
            document.getElementById("longitude").value = e.lngLat.lng;

            getReverseGeocodingData(e.lngLat.lat, e.lngLat.lng);
        });


        function getReverseGeocodingData(latitude, longitude) {
            var url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'
                + longitude + ', ' + latitude
                + '.json?access_token=' + mapboxgl.accessToken;
            // This is making the Geocode request
            $.get(url, function (data) {
                var place_name = data.features[0].place_name.split(",");
                var kecamatan = place_name[1].substring(1);
                var kabupaten = place_name[2];
                var provinsi = place_name[3]
                document.getElementById("full_address").value = kecamatan + ", " + kabupaten + ", " + provinsi;

            }).fail(function (jqXHR, textStatus, errorThrown) {
                alert("There was an error while geocoding: " + errorThrown);
            });
        }

    </script>


@endsection
