@extends('templates.main')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">


            <div class="d-sm-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    <p class="card-subtitle card-subtitle-dash">You have {{ $project->count(); }} data Projects</p>
                </div>
                <div>
                    <a class="btn btn-block btn-danger text-white">Download Report</a>
                    <a class="btn btn-block btn-primary text-white" href="/project/create">Add Projects</a>
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
                    <th>Pilot</th>
                    <th>Drone Name</th>
                    <th>Start Date</th>
                    <th>Until Date</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($project as $item)
                  <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->drone_name }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->until_date }}</td>
                    <td>{{ $item->status_project }}</td>
                    <td class="text-center">
                        <a href="/project/detail/{{ $item->id_projects }}" class=""><i class="icon-sm mdi mdi-eye text-success"></i></a>
                        <a href="/project/edit/{{ $item->id_projects }}" class="px-2"><i class="icon-sm mdi mdi-table-edit text-primary"></i></a>
                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id_projects }}"><i class="icon-sm mdi mdi-delete-forever text-danger"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      @foreach ($project as $item)
      <div class="modal fade" id="exampleModal{{ $item->id_projects }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">DELETE {{ $item->id_projects }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete {{ $item->id_projects }} ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary text-light" data-bs-dismiss="modal">NO</button>
              <a href="/project/delete/{{ $item->id_projects }}" class="btn btn-danger text-light">YES</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <!-- Modal -->



@endsection
