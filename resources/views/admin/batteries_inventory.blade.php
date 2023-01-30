@extends('templates.main')

@section('content')
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
    
            
            <div class="d-sm-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    <p class="card-subtitle card-subtitle-dash">You have {{ $batteries->count(); }} data Battery</p>
                </div>
                <div>
                  <a class="btn btn-block btn-danger text-white" href="/inventory/batteries/download" target="_blank">Download Report</a>
                    <a class="btn btn-block btn-primary text-white" href="/inventory/batteries/create">Add Batteries</a>
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
                    <th>Item</th>
                    <th>Type</th>
                    <th>Long Battery Life</th>
                    <th>Battery Capacity</th>
                    <th>Battery Voltage</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($batteries as $item)
                  <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $item->batteries_name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->long_life }}</td>
                    <td>{{ $item->capacity }}</td>
                    <td>{{ $item->voltage }}</td>
                    <td class="text-center">
                        <a href="/inventory/batteries/detail/{{ $item->id }}" class=""><i class="icon-sm mdi mdi-eye text-success"></i></a>
                        <a href="/inventory/batteries/edit/{{ $item->id }}" class="px-2"><i class="icon-sm mdi mdi-table-edit text-primary"></i></a>
                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}"><i class="icon-sm mdi mdi-delete-forever text-danger"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      @foreach ($batteries as $item)
      <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">DELETE {{ $item->batteries_name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete {{ $item->batteries_name }} ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary text-light" data-bs-dismiss="modal">NO</button>
              <a href="/inventory/batteries/delete/{{ $item->id }}" class="btn btn-danger text-light">YES</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <!-- Modal -->

@endsection