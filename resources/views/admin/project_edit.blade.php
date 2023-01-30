@extends('templates.main')

@section('content')
    

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>


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
                <input type="text" class="form-control @error('mission_flight') is-invalid @enderror" placeholder="Mission Flight" name="mission_flight" value="{{ $project->mission_flight }}">
                    <div class="invalid-feedback">
                        @error('mission_flight')
                        {{ $message }}
                        @enderror
                    </div>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Select Drone</label>
                <select class="form-select form-select-sm" name="id_drone">
                        <option value="{{ $project->status_project }}" {{ ($project->status_project == 'Rental') ? 'selected' : '' }}>Rental</option>
                        <option value="{{ $project->status_project }}" {{ ($project->status_project == 'Done') ? 'selected' : '' }}>Done</option>
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
    function initMap() {

        var latValue = parseFloat(document.getElementById("value_lat").value);
        var longValue = parseFloat(document.getElementById("value_long").value);

        var myLatLng = {lat: latValue, lng: longValue};
    
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