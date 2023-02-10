@extends('templates.main')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-between align-items-start mb-3">
        <div class="col-md-7">
          <h4 class="card-title card-title-dash">{{ $title }}</h4>
        </div>
        <div class="col-md-3">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" name="id" placeholder="Search by ID Project" style="height: 2.2rem;" aria-label="Search" aria-describedby="basic-addon2">
              <button type="submit" class="btn btn-block btn-primary text-white" type="button" id="button-addon2"><i class="mdi mdi-magnify"></i></button>
            </div>
          </form>
        </div>
        <!-- <div class="col-md-2 px-0">
          @if(isset($id_drone))
          <a class="btn btn-block btn-danger text-white" href="{{route('calendar.download', ['id' => $id_drone])}}" target="_blank">Download Report</a>
          @else
          <span class="btn btn-block btn-secondary text-white" href="#">Download Report</span>
          @endif
        </div> -->
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
        @else
          <div class="col-md-12 px-1 mb-3">
            <p>Please input ID Project for more info</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


@endsection