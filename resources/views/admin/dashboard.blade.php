@extends('templates.main')

@section('content')
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
    
            
            <div class="d-sm-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="card-title card-title-dash">{{ $title }}</h4>
                </div>
            </div>

            @can('admin')
            <div class="row">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Project</h4>
                        <div class="row">
                        <div class="col-sm-4">
                            <p class="status-summary-ight-white mb-1">Total Projects</p>
                            <h2 class="text-light">{{ $project->count(); }}</h2>
                        </div>
                        <div class="col-sm-8">
                            <div class="status-summary-chart-wrapper pb-4">
                           
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Drone</h4>
                        <div class="row">
                        <div class="col-sm-4">
                            <p class="status-summary-ight-white mb-1">Total Drones</p>
                            <h2 class="text-light">{{ $batteries->count(); }}</h2>
                        </div>
                        <div class="col-sm-8">
                            <div class="status-summary-chart-wrapper pb-4">
                           
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Batteries</h4>
                        <div class="row">
                        <div class="col-sm-4">
                            <p class="status-summary-ight-white mb-1">Total Batteries</p>
                            <h2 class="text-light">{{ $batteries->count(); }}</h2>
                        </div>
                        <div class="col-sm-8">
                            <div class="status-summary-chart-wrapper pb-4">
                           
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Equipments</h4>
                        <div class="row">
                        <div class="col-sm-4">
                            <p class="status-summary-ight-white mb-1">Total Equipment</p>
                            <h2 class="text-light">{{ $equipments->count(); }}</h2>
                        </div>
                        <div class="col-sm-8">
                            <div class="status-summary-chart-wrapper pb-4">
                           
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Kits</h4>
                        <div class="row">
                        <div class="col-sm-4">
                            <p class="status-summary-ight-white mb-1">Total Kits</p>
                            <h2 class="text-light">{{ $kits->count(); }}</h2>
                        </div>
                        <div class="col-sm-8">
                            <div class="status-summary-chart-wrapper pb-4">
                           
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>
            @endcan

            
       
          </div>
        </div>
      </div>



@endsection