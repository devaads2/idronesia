@extends('templates.main')

@section('content')
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    {{-- <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    <p class="card-subtitle card-subtitle-dash">Created at {{ $kits->created_at }}</p> --}}
                </div>
            </div>

                <div class="row">
                        
                    {{-- Text --}}
                    <div class="col">
                        <div class="form-group">

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Projects Id</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->id_projects }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Pilot</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->name }}" disabled>
                            </div>
                            {{-- <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Checklist Id</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->id_checklist }}" disabled>
                            </div> --}}
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Drone Name</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->drone_name }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Battries Name</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->batteries_name }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Equipments Name</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->equipments_name }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Kits Name</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->kits_name }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Start Date</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->start_date }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Until Date</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->until_date }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Mission Flight</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->mission_flight }}" disabled>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Status Project</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $project->status_project }}" disabled>
                            </div>
                            
                        </div>

                        <div>
                            <a class="btn btn-block btn-md btn-danger text-white" href="/project">Back to Data Projects</a>
                        </div>

                    </div>
                    {{-- End Text --}}

                    {{-- Image --}}
                    <div class="col">
                        <div class="">
                            <div id="map"></div>
                        </div>
                      
                        <script type="text/javascript">
                            function initMap() {
                                var value_lat = {{ Js::from($project->latitude) }};
                                var value_long = {{ Js::from($project->longitude) }};
                              const myLatLng = { lat: value_lat, lng: value_long };
                              const map = new google.maps.Map(document.getElementById("map"), {
                                zoom: 15,
                                center: myLatLng,
                              });
                      
                              new google.maps.Marker({
                                position: myLatLng,
                                map,
                                title: "Hello Rajkot!",
                              });
                            }
                      
                            window.initMap = initMap;
                        </script>
                      
                        <script type="text/javascript"
                            src="https://maps.google.com/maps/api/js?key=AIzaSyD-9yZaNNbTuegDhID4kL_3CVx3JBslM6Q&callback=initMap" ></script>
                    </div>
                    {{-- End Image --}}

                </div>
        
                {{-- <div>
                    <a class="btn btn-block btn-md btn-danger text-white" href="/inventory/kits">Back to Kits Inventory</a>
                </div> --}}

          </div>
        </div>
      </div>

@endsection