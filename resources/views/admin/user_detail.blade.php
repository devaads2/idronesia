@extends('templates.main')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">{{ $title }}</h4>
                </div>
            </div>

                <div class="row">

                    {{-- Text --}}
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                    <span class="input-group-text bg-dark text-bold">User Id</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->id }}">
                                </div>

                            <div class="input-group mb-1">
                            <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Name</span>
                            </div>
                            <input type="text" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Email</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Address</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->address }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Phone</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->phone }}">
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-50">
                                <span class="input-group-text bg-dark text-bold">Level</span>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->level }}">
                            </div>
                        </div>
                    </div>
                    {{-- End Text --}}

                    {{-- Image --}}
                    <div class="col-6">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ url('assets/photos/profile/'.$user->image) }}" style="height: 250px;"  alt="...">
                            </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Image --}}

                </div>

                <div>
                    <a class="btn btn-block btn-md btn-danger text-white" href="/user">Back to User List</a>
                </div>

          </div>
        </div>
      </div>

@endsection
