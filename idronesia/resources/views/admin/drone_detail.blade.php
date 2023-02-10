@extends('templates.main')

@section('content')
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    <p class="card-subtitle card-subtitle-dash">Created at {{ $drone->created_at }}</p>
                </div>
            </div>

                <div class="row">
                        
                    {{-- Text --}}
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">Drone Id</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->id }}">
                                </div>

                            <div class="input-group mb-1">
                            <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Item Name</span>
                            </div>
                            <input type="text" class="form-control" value="{{ $drone->drone_name }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Max. Flying</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->max_flying_alt }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Adjustable Angel</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->adjustable_angel_camera }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">EIS</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->eis }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Control Distance</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->control_distance }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Wifi Image Transmission Distance</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->wifi_transmission }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Video Resolution</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->video_res }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Photo Resolution</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->photo_res }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Product Weight</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $drone->product_weight }}">
                            </div>
                        </div>
                    </div>
                    {{-- End Text --}}

                    {{-- Image --}}
                    <div class="col">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ url('assets/photos/'.$drone->image) }}" class="d-block w-100" alt="...">
                            </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Image --}}

                </div>
        
                <div>
                    <a class="btn btn-block btn-md btn-danger text-white" href="/inventory/drone">Back to Drone Inventory</a>
                </div>

          </div>
        </div>
      </div>

@endsection