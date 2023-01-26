@extends('templates.main')

@section('css')
    #container {
    height: auto;
    border: 2px solid black;
    position: relative;
    }

    #label {
    position: absolute;
    top: -10px;
    left: 20px;
    height: 20px;
    width: auto;
    padding-left: 10px;
    padding-right: 10px;
    background-color: white;
    text-align: center;
    }

    #checklist {
    margin-left: -15px;
    }

    .ttd {
    margin-top: 7rem !important;
    }
@endsection

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between align-items-start">
                    <div class="col-md-6">
                        <h4 class="card-title card-title-dash">{{ $title }}</h4>
                    </div>
                    <div class="col-md-4">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" name="id" placeholder="Search by ID Project"
                                       style="height: 2.2rem;" aria-label="Search" aria-describedby="basic-addon2">
                                <button type="submit" class="btn btn-block btn-primary text-white" type="button"
                                        id="button-addon2"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2 px-0">
                        @if(isset($checklist))
                            <span>
                                <a class="btn btn-info btn-icon-text print-button" href="/document/print/{{$detail->id_projects}}}"
                                   target="_blank">Print<i class="ti-printer btn-icon-append"></i></a>
                            </span>
                        @else
                            <span class="btn btn-block btn-secondary text-black btn-icon-text disabled" href="#">Print<i
                                    class="ti-printer btn-icon-append"></i></span>
                        @endif
                    </div>
                </div>

                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('message_error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('message_error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(isset($detail))
                    @php
                        $visual = json_decode($checklist[0]->visual);
                        $control = json_decode($checklist[0]->control);
                        $propellers = json_decode($checklist[0]->propellers);
                        $power = json_decode($checklist[0]->power);
                        $payload = json_decode($checklist[0]->payload);
                        $monitor = json_decode($checklist[0]->monitor);
                    @endphp
                    <div class="col-12">
                        <div class="row text-center mb-2 mt-4">
                            <h4><b>MULTIROTOR PRE CHECK FLIGHT & POST FLIGHT</b></h4>
                        </div>
                        <hr class="mb-4">
                        <dl class="row">
                            <dt class="col-sm-3">ID Transaction</dt>
                            <dd class="col-sm-9">{{$detail->id_projects}}</dd>

                            <dt class="col-sm-3">Start Date</dt>
                            <dd class="col-sm-4">{{$detail->start_date}}</dd>
                            <dt class="col-sm-2">End Date</dt>
                            <dd class="col-sm-3">{{$detail->until_date}}</dd>

                            <dt class="col-sm-3">Mission Flight</dt>
                            <dd class="col-sm-9">{{$detail->mission_flight}}</dd>

                            <dt class="col-sm-3">Location</dt>
                            <dd class="col-sm-9">{{$detail->full_address}}</dd>

                            <dt class="col-sm-3">Remote Pilot</dt>
                            <dd class="col-sm-9">{{$detail->name}}</dd>
                        </dl>

                        <div class="row m-3">
                            <div id="container">
                                <div id="label"><b>Preparation</b></div>
                                <dl class="row mt-4">
                                    <dt class="col-sm-3">Drone</dt>
                                    <dd class="col-sm-9">{{$detail->drone_name}}</dd>

                                    <dt class="col-sm-3">Batteries</dt>
                                    <dd class="col-sm-9">{{$detail->batteries_name}}</dd>

                                    <dt class="col-sm-3">Equipment</dt>
                                    <dd class="col-sm-9">{{$detail->equipments_name}}</dd>

                                    <dt class="col-sm-3">Kit</dt>
                                    <dd class="col-sm-9">{{$detail->kits_name}}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="row m-3">
                            <div id="container">
                                <div id="label"><b>Visual Inspection of Component</b></div>
                                <dl class="row mt-4">
                                    <div class="row align-items-center">
                                        <div class="col-sm-9"></div>
                                        <div class="col-sm-3" id="checklist"><b>Checklist</b></div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Drone Component Complete</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="drone_component_complete"
                                                        {{ in_array('Drone Component Complete',$visual) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Component Installed Correctly</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="component_installed_correctly"
                                                        {{ in_array('Component Installed Correctly',$visual) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">No Crack or Dent</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="no_crack_or_dent"
                                                        {{ in_array('No Crack or Dent',$visual) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Overall Structure Condition</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="overall_structure_condition"
                                                        {{ in_array('Overall Structure Condition',$visual) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Linkages</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="overall_structure_condition"
                                                        {{ in_array('Linkages',$visual) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Registration Marking Display Properly</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="overall_structure_condition"
                                                        {{ in_array('Registration Marking Display Properly',$visual) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </dl>
                            </div>

                        </div>

                        <div class="row m-3">
                            <div id="container">
                                <div id="label"><b>Control Surface and Motor</b></div>
                                <dl class="row mt-4">
                                    <div class="row align-items-center">
                                        <div class="col-sm-9"></div>
                                        <div class="col-sm-3" id="checklist"><b>Checklist</b></div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Propulsion System</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="battery_level"
                                                        {{ in_array('Propulsion System',$control) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Propeller Attached Correctly and Secure</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="software_updates"
                                                        {{ in_array('Propeller Attached Correctly and Secure',$control) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Check Abnormal Noise</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="cables_correctly_connect"
                                                        {{ in_array('Check Abnormal Noise',$control) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </dl>
                            </div>

                        </div>

                        <div class="row m-3">
                            <div id="container">
                                <div id="label"><b>Propellers</b></div>
                                <dl class="row mt-4">
                                    <div class="row align-items-center">
                                        <div class="col-sm-9"></div>
                                        <div class="col-sm-3" id="checklist"><b>Checklist</b></div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Condition as per Design</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="condition_as_per_design"
                                                        {{ in_array('Condotions as per Design',$propellers) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Dent or Cracks</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="dent_or_crack"
                                                        {{ in_array('Dent or Cracks',$propellers) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Correctly Orientation</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Correctly Orientation',$propellers) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="row m-3">
                            <div id="container">
                                <div id="label"><b>Power System / Battery</b></div>
                                <dl class="row mt-4">
                                    <div class="row align-items-center">
                                        <div class="col-sm-9"></div>
                                        <div class="col-sm-3" id="checklist"><b>Checklist</b></div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Physical Condition</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="condition_as_per_design"
                                                        {{ in_array('Physical Condition',$power) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Fully Charge / Sufficient for Operation</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="dent_or_crack"
                                                        {{ in_array('Fully Charge / Sufficient for Operation',$power) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Check for Installation</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Check for Installation',$power) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">No Damage Wiring/Loose</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('No Damage Wiring/Loose',$power) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Compartement Lid Close/Locked</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Compartement Lid Close/Locked',$power) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </dl>
                            </div>
                        </div>

                        <div class="row m-3">
                            <div id="container">
                                <div id="label"><b>Payload</b></div>
                                <dl class="row mt-4">
                                    <div class="row align-items-center">
                                        <div class="col-sm-9"></div>
                                        <div class="col-sm-3" id="checklist"><b>Checklist</b></div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Memory Card (Micro SD)</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="condition_as_per_design"
                                                        {{ in_array('Memory Card (Micro SD)',$payload) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Check Payload Setting</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="dent_or_crack"
                                                        {{ in_array('Check Payload Setting',$payload) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Secure Connection and Cables</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Secure Connection and Cables',$payload) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Check Functionality</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Check Functionality',$payload) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Parachute Recovery (if any)</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Parachute Recovery (if any)',$payload) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </dl>
                            </div>
                        </div>

                        <div class="row m-3">
                            <div id="container">
                                <div id="label"><b>GCS / Monitor</b></div>
                                <dl class="row mt-4">
                                    <div class="row align-items-center">
                                        <div class="col-sm-9"></div>
                                        <div class="col-sm-3" id="checklist"><b>Checklist</b></div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Battery Level</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="condition_as_per_design"
                                                        {{ in_array('Battery Level',$monitor) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Cables Correctly Connect</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="dent_or_crack"
                                                        {{ in_array('Cables Correctly Connect',$monitor) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Display Functioning Correctly</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Display Functioning Correctly',$monitor) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Software Update</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Software Update',$monitor) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">GCS/Monitor Connected to UAS</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('GCS/Monitor Connected to UAS',$monitor) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <dt class="col-sm-9">Telemetry Reading - All Normal</dt>
                                        <div class="col-sm-3">
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="correctly_orientation"
                                                        {{ in_array('Telemetry Reading - All Normal',$monitor) ? 'checked' : '' }}
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </dl>
                            </div>
                        </div>

                    </div>

                    <a href="/document" class="btn btn-danger btn-lg text-light">Back</a>

                    @if(isset($detailPrint))
                        <div class="row text-center mt-3">
                            <div class="row">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <h5>Denpasar, {{date("d/m/Y")}}</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <br>
                                    <h5>Remote Pilot</h5>
                                    <h5 class="ttd">{{$detail->name}}</h5>
                                </div>
                            </div>
                        </div>
                    @endif

            </div>
            @else
                <p>Please input Project ID for more info</p>
            @endif
        </div>
    </div>
    <!-- Modal -->

    <script type="text/javascript">
        $("input:checkbox").click((e) => {
            e.stopPropagation();
            return false;
        });
    </script>


@endsection
