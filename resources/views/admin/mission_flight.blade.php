@extends('templates.main')
@push('css_extend')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endpush

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">


                <div class="d-sm-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    </div>
                    <div>
                        <a class="btn btn-block btn-primary text-white" id="newMissionBtn">Add New Mission Flight</a>
                    </div>
                </div>

                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @include('admin.mission_flight_modal')

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Mission Flight</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($missionflights as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->mission_flight_name }}</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-id="{{ $item->mission_flight_id }}"
                                       class="px-2 edit-btn"><i class="icon-sm mdi mdi-table-edit text-primary"></i></a>
                                    <a href="" class="" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal{{ $item->mission_flight_id }}"><i
                                            class="icon-sm mdi mdi-delete-forever text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($missionflights as $item)
        <div class="modal fade" id="exampleModal{{ $item->mission_flight_id }}" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">DELETE {{ $item->mission_flight_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete {{ $item->mission_flight_name }} ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary text-light" data-bs-dismiss="modal">NO</button>
                        <a href="/datamaster/missionflight/delete/{{ $item->mission_flight_id }}"
                           class="btn btn-danger text-light">YES</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal -->

@endsection

@push('script_extend')
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });


        $(function () {

            $('#newMissionBtn').click(function () {
                $('#saveBtn').html("Create");
                $('#categoryForm').attr('action', '/datamaster/missionflight/insert' );
                $('#mission_flight_id').val('');
                $('#categoryForm').trigger("reset");
                $('#modalHeading').html("Create New Mission Flight");
                $('#categoryModal').modal('show');
            });

            $('body').on('click', '.edit-btn', function () {
                var missionId = $(this).data('id');
                $.get("/datamaster/missionflight/edit" + '/' + missionId, function (data) {
                    $('#modalHeading').html("Edit Mission Flight");
                    $('#saveBtn').html("Save");
                    $('#categoryForm').attr('action', '/datamaster/missionflight/update/'+missionId );
                    $('#categoryModal').modal('show');
                    $('#mission_flight_id').val(data.mission_flight_id);
                    $('#mission_flight_name').val(data.mission_flight_name);
                });
            });
        });
    </script>
@endpush
