@extends('templates.main')

@push('css_extend')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

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

                <table id="report-table" class="table table-bordered table-paginate" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Mission Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
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

        $(document).ready(function () {
            var dt = $('#report-table').DataTable({
                "processing": true,
                "serverSide": false,
                "ajax": "{{route('report.get')}}" ,
                "columns": [
                    {
                        "data": "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                    {"data": "action",
                        "render": function(data, type, row) {
                            return "<span class='btn btn-primary btn-fw m-0 text-white' style='line-height: 20px' onclick=window.location.href='/report/detail/" + row.id_projects + "'> View</span>"
                        },
                    },
                ],
                "order": [[1, 'asc']]
            });

        });
    </script>
@endpush
