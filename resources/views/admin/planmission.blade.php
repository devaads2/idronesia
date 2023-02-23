@extends('templates.main')

@push('css_extend')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <style type="text/css">
        td.details-control {
            background: url("/assets/images/plus.png") no-repeat center center;
            background-size: 20px;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url("/assets/images/minus.png") no-repeat center center;
            background-size: 20px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

@endpush

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    </div>
                </div>

                <table id="plan-mission-table" class="table table-bordered table-paginate" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Mission Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Approval</th>
                    </tr>
                    </thead>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <input type="hidden" id="project_id" name="project_id" value="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalTitle">Complete or Cancel this Mission</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <input class="form-check-input" type="radio" name="statusRadio" id="completeCheck" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Complete Mission
                                        </label>
                                    </div>

                                    <div class="col-6">
                                        <input class="form-check-input" type="radio" name="statusRadio" id="cancelCheck">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Cancel Mission
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close-modal btn btn-secondary text-white" data-dismiss="modal">Close</button>
                                <button id="saveFinalizeButton" type="button" class="btn btn-primary text-white">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script_extend')

    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        function format(d) {
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" class="table table-striped table-bordered">'+
                '<h5 style="padding-left: 5px">Mision Detail</h5>'+
                '<tr>'+
                '<td>Pilot name</td>'+
                '<td>'+d.name+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Drone name</td>'+
                '<td>'+d.drone_name+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Equipments Name</td>'+
                '<td>'+d.equipments_name+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Kit Name</td>'+
                '<td>'+d.kits_name+'</td>'+
                '</tr>'+
                '</table>';
        }

        $(document).ready(function () {
            var dt = $('#plan-mission-table').DataTable({
                "processing": true,
                "serverSide": false,
                "ajax": "{{route('plan_mission.get')}}" ,
                "columns": [
                    {
                        "class": "details-control",
                        "orderable": false,
                        "data": null,
                        "defaultContent": ""
                    },
                    {"data": "mission_flight_name"},
                    {"data": "start_date"},
                    {"data": "until_date"},
                    {"data": "status_project",
                        "render": function(data, type, row) {
                            if(row.status_project === "On Schedule") {
                                return '<span class="btn btn-primary btn-fw m-0 text-white" style="line-height: 20px"> On Schedule</span>'
                            } else if (row.status_project === "On Flight") {
                                return '<span class="btn btn-info btn-fw m-0 text-white" style="line-height: 20px">On Flight</span>'
                            } else if (row.status_project === "Cancelled") {
                                return '<span class="btn btn-danger btn-fw m-0 text-white" style="line-height: 20px">Cancelled</span>'
                            } else {
                                return '<span class="btn btn-success btn-fw m-0 text-white" style="line-height: 20px">Complete</span>'
                            }

                        },
                    },
                    {
                        targets: -1,
                        className: 'text-center',
                        data: "null",
                        defaultContent: '<button class="btn btn-info white btn-icon-text text-white m-0 style="line-height: 20px" '+
                            'style="line-height: 20px">Finalize'+
                            '<i class="mdi mdi-calendar-check btn-icon-append"></i></button>',
                    },
                ],
                "order": [[1, 'asc']]
            });

            $('#plan-mission-table tbody').on('click', 'tr td:first-child', function () {
                var tr = $(this).parents('tr');
                var row = dt.row(tr);

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();
                } else {
                    tr.addClass('details');
                    row.child(format(row.data())).show();
                }
            });

            $('#plan-mission-table tbody').on('click', 'button', function () {
                var data = dt.row($(this).parents('tr')).data();
                console.log(data);
                $('#confirmationModal').modal("show");
                $('#project_id').val(data['id_projects']);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#saveFinalizeButton').on('click', function () {
                var projectId = $('#project_id').val();
                var status = 'Complete';

                if(document.getElementById('completeCheck').checked) {
                    status = 'Complete';
                } else if(document.getElementById('cancelCheck').checked) {
                    status = 'Cancelled';
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('project.finalize')}}",
                    data: {
                        'id' : projectId,
                        'status' : status
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#plan-mission-table').DataTable().ajax.reload();
                        $('#confirmationModal').modal('hide');
                    },
                    error: function (data) {
                        $('#confirmationModal').modal('hide');
                    }
                });
            });

            $('.close-modal').on('click', function () {
                $('#confirmationModal').modal('hide');
            });

            $('.close').on('click', function () {
                $('#confirmationModal').modal('hide');
            });
        });

    </script>
@endpush
