@extends('templates.main')

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
                    <input class="typeahead @error('start_date') is-invalid @enderror" type="date" name="start_date">
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
                    <input class="typeahead @error('until_date') is-invalid @enderror" type="date" name="until_date">
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
                <input type="text" class="form-control @error('mission_flight') is-invalid @enderror" placeholder="Mission Flight" name="mission_flight" value="{{ old('mission_flight') }}">
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

            <div class="form-group">
                <input type="hidden" class="form-control" name="latitude" id="latitude">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="longitude" id="longitude">
            </div>

            <div class="form-group row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputName1">Select Manager</label>
                        <select class="form-select form-select-sm @error('id_manager') is-invalid @enderror" name="id_manager">
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
                        <select class="form-select form-select-sm @error('id_pilot') is-invalid @enderror" name="id_pilot">
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
                        <select class="form-select form-select-sm @error('id_drone') is-invalid @enderror" name="id_drone">
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
                        <select class="form-select form-select-sm @error('id_batteries') is-invalid @enderror" name="id_batteries">
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
                        <select class="form-select form-select-sm @error('id_equipments') is-invalid @enderror" name="id_equipments">
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
                        <select class="form-select form-select-sm @error('id_kits') is-invalid @enderror" name="id_kits">
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



    <script>
    function initMap() {
        var myLatLng = {lat: -8.673233, lng: 115.226438};

        var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 13
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!',
            draggable: true
            });

        google.maps.event.addListener(marker, 'dragend', function(marker) {
            var latLng = marker.latLng;
            // document.getElementById('lat-span').innerHTML = latLng.lat();
            // document.getElementById('lon-span').innerHTML = latLng.lng();
            document.getElementById("latitude").value = latLng.lat();
            document.getElementById("longitude").value = latLng.lng();
        });
    }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap" async defer></script>



      </div>
    </div>
</div>




@endsection
