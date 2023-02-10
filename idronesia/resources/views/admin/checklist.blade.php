@extends('templates.main')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">


            <div class="d-sm-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    <p class="card-subtitle card-subtitle-dash">You have {{ $project->count(); }} data Checklist</p>
                </div>
                <div>
                  <a class="btn btn-block btn-danger text-white" href="/inventory/kits/download" target="_blank">Download Report</a>
                    <a class="btn btn-block btn-primary text-white" href="/inventory/kits/create">Add kits</a>
                </div>
            </div>

            @if (session('message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Drone Name</th>
                    <th>Mission Flight</th>
                    <th>Start Date</th>
                    <th>Until Date</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($project as $item)
                  <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $item->drone_name }}</td>
                    <td>{{ $item->mission_flight }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->until_date }}</td>
                    <td class="text-center">
                        <a href="/checklist/create/{{ $item->id_checklist }}" class=""><i class="icon-sm mdi mdi-eye text-success"></i></a>
                        {{-- <a href="/checklist/create/{id}" class="px-2"><i class="icon-sm mdi mdi-table-edit text-primary"></i></a>
                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}"><i class="icon-sm mdi mdi-delete-forever text-danger"></i></a>
                    </td> --}}
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- @foreach ($kits as $item)
      <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">DELETE {{ $item->kits_name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete {{ $item->kits_name }} ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary text-light" data-bs-dismiss="modal">NO</button>
              <a href="/inventory/kits/delete/{{ $item->id }}" class="btn btn-danger text-light">YES</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <!-- Modal --> --}}

@endsection
