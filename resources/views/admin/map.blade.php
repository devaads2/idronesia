@extends('templates.main')

@section('content')
    

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        
        <div class="d-sm-flex justify-content-between align-items-start mb-3">
            <div>
                <h4 class="card-title card-title-dash">{{ $title }}</h4>
                {{-- <p class="card-subtitle card-subtitle-dash">You have {{ $project->count(); }} data Projects</p> --}}
            </div>
        </div>

      
        <div id="map" style='height:400px'></div>
        
      </div>
    </div>
  </div>

{{--  --}}

<script type="text/javascript">
    function initializeMap() {
        const locations = <?php echo json_encode($project) ?>;

        console.log(locations);

        const map = new google.maps.Map(document.getElementById("map"));
        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        for (var location of locations) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(location.latitude, location.longitude),
                map: map
            });
            bounds.extend(marker.position);
            google.maps.event.addListener(marker, 'click', (function(marker, location) {
                return function() {
                    infowindow.setContent(
                        "Drone Name : " + location.drone_name + " <br> "
                        + "Mission Flight : " + location.mission_flight + " <br> "
                        + "Pilot : " +location.id_user);
                    infowindow.open(map, marker);
                }
            })(marker, location));

        }
        map.fitBounds(bounds);
    }
</script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyD-9yZaNNbTuegDhID4kL_3CVx3JBslM6Q&callback=initializeMap"></script>



@endsection