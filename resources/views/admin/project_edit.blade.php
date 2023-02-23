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
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif


        <form class="forms-sample" action="/project/update/{{ $project->id_projects }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <div class="col">
                  <label>Start Date</label>
                  <div id="the-basics">
                    <input class="typeahead" type="date" name="start_date" value="{{ $project->start_date }}">
                  </div>
                </div>
                <div class="col">
                  <label>Until Date</label>
                  <div id="bloodhound">
                    <input class="typeahead" type="date" name="until_date" value="{{ $project->until_date }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                        <label for="exampleInputName1">Mission Flight</label>
                        <select class="form-select form-select-sm" name="id_mission_flight">
                            @foreach ($missionflight as $d)
                                <option value="{{ $d->mission_flight_id }}" {{ ($d->mission_flight_id == $project->id_mission_flight) ? 'selected' : '' }}>{{ $d->mission_flight_name }}</option>
                            @endforeach
                        </select>
                      </div>

              <div class="form-group">
                <label for="status_project">Project Status</label>
                <select class="form-select form-select-sm" name="status_project" disabled>
                        <option value="{{ $project->status_project }}" {{ ($project->status_project == 'On Schedule') ? 'selected' : '' }}>On Schedule</option>
                        <option value="{{ $project->status_project }}" {{ ($project->status_project == 'On Flight') ? 'selected' : '' }}>On Flight</option>
                        <option value="{{ $project->status_project }}" {{ ($project->status_project == 'Complete') ? 'selected' : '' }}>Complete</option>
                        <option value="{{ $project->status_project }}" {{ ($project->status_project == 'Cancelled') ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>


              {{-- oldvalue --}}
            <div class="form-group">
                <input type="hidden" class="form-control" id="value_lat" value="{{ $project->latitude }}">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="value_long" value="{{ $project->longitude }}">
            </div>

            <div id="map"></div>

            <div class="form-group">
                <input type="hidden" class="form-control" name="latitude" id="latitude" value="{{ $project->latitude }}">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="longitude" id="longitude" value="{{ $project->longitude }}">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="full_address" id="full_address" value="{{ $project->full_address }}">
            </div>

            <div class="form-group row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputName1">Select Drone</label>
                        <select class="form-select form-select-sm" name="id_drone">
                            @foreach ($drone as $d)
                                <option value="{{ $d->id }}" {{ ($d->id == $project->id_drone) ? 'selected' : '' }}>{{ $d->drone_name }}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputName1">Select Battries</label>
                        <select class="form-select form-select-sm" name="id_batteries">
                            @foreach ($batteries as $b)
                                <option value="{{ $b->id }}" {{ ($b->id == $project->id_batteries) ? 'selected' : '' }}>{{ $b->batteries_name }}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputName1">Select Equipments</label>
                        <select class="form-select form-select-sm" name="id_equipments">
                            @foreach ($equipments as $e)
                                <option value="{{ $e->id }}" {{ ($e->id == $project->id_equipments) ? 'selected' : '' }}>{{ $e->equipments_name }}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputName1">Select Kits</label>
                        <select class="form-select form-select-sm" name="id_kits">
                            @foreach ($kits as $k)
                                <option value="{{ $k->id }}" {{ ($k->id == $project->id_kits) ? 'selected' : '' }}>{{ $k->kits_name }}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
              </div>

          <button type="submit" class="btn btn-primary btn-lg text-light">Submit</button>
          <a href="/project" class="btn btn-danger btn-lg text-light">Cancel</a>

        </form>

          <script>
              const project = <?php echo json_encode($project) ?>;
              const longitude = project.longitude;
              const latitude = project.latitude;

              mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2YWFkczIiLCJhIjoiY2xkYms3cWoyMDFkcTN2bnhvMHpkem0yeCJ9.ATwIXZyH200QMvg0Cb3EjA';
              var map = new mapboxgl.Map({
                  container: 'map',
                  style: 'mapbox://styles/mapbox/streets-v11',
                  center: [longitude, latitude],
                  zoom: 10,
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

              let marker = new mapboxgl.Marker()
                  .setLngLat([longitude, latitude])
                  .addTo(map);

              // let marker = null
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
      </div>
    </div>
</div>




@endsection
