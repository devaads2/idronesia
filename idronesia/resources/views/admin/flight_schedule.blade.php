@extends('templates.main')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-between align-items-start">
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
        <div class="col-md-2 px-0">
          @if(isset($detail))
          <a class="btn btn-block btn-danger text-white" href="{{route('flight.download', ['id' => $id_drone])}}" target="_blank">Download Report</a>
          @else
          <span class="btn btn-block btn-secondary text-white" href="#">Download Report</span>
          @endif
        </div>
      </div>

      @if (session('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if(isset($detail))
      <div class="table-responsive">
        <table class="table table-responsive table-striped mt-3 mb-5">
          <tr>
            <td style="width: 20%;">ID Transaction</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->id_projects }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Start Date</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->start_date }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Until Date</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->until_date }}</td>
          </tr>
          <tr>
            <td>Mission Flight</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->mission_flight }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Location</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->latitude }}, {{ $detail->longitude }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Customer</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->name }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Remote Pilot</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->name }}</td>
          </tr>
        </table>
        <table class="table table-responsive table-striped mt-3">
          <tr>
            <td style="width: 20%;">Drone</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->drone_name }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Batteries</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->batteries_name }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Equipments</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->equipments_name }}</td>
          </tr>
          <tr>
            <td style="width: 20%;">Kit</td>
            <td style="width: 2%;">:</td>
            <td>{{ $detail->kits_name }}</td>
          </tr>
        </table>
        <div class="text-center">
          <img class="w-50" src="{{ asset('assets/photos/drone.jpeg') }}" alt="">
        </div>
      </div>
      @else
        <p>Please input ID Project for more info</p>
      @endif
    </div>
  </div>
</div>
<!-- Modal -->


@endsection