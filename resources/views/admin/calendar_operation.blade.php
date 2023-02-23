@extends('templates.main')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between align-items-start mb-3">
                    <div class="col-md-7">
                        <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    </div>
                </div>

                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row justify-content-between align-items-start mb-3">
                    <div class="col-md-7">
                        <h6>Drone : {{ $droneName }}</h6>
                    </div>
                </div>

                <div class="row px-3">
                    @if(isset($rangeDate))
                        @foreach ($rangeDate as $item)
                            <div class="col-md-2 px-1 mb-3">
                                <div class="card" style="border-radius: 5px !important;">
                                    <div class="card-body mx-auto">{{$item}}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <a href="/calendar" class="btn btn-danger btn-lg text-light">Back</a>
            </div>
        </div>
    </div>
    <!-- Modal -->


@endsection
