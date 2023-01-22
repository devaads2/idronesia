@extends('templates.main')

@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>

        <form class="forms-sample" action="/checklist/insert/{{ $checklist[0]->id_checklists }}" method="POST" enctype="multipart/form-data">
            @csrf


            @php
                $visual = json_decode($checklist[0]->visual);
                $control = json_decode($checklist[0]->control);
                $propellers = json_decode($checklist[0]->propellers);
                $power = json_decode($checklist[0]->power);
                $payload = json_decode($checklist[0]->payload);
                $monitor = json_decode($checklist[0]->monitor);
            @endphp

          <div class="form-group">
            <h4>Visual Inspection of Component</h4>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="visual[]" value="Drone Component Complete" {{ in_array('Drone Component Complete',$visual) ? 'checked' : '' }}>
                Drone Component Complete
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="visual[]" value="Component Installed Correctly" {{ in_array('Component Installed Correctly',$visual) ? 'checked' : '' }}>
                Component Installed Correctly
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="visual[]" value="No Crack or Dent" {{ in_array('No Crack or Dent',$visual) ? 'checked' : '' }}>
                No Crack or Dent
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="visual[]" value="Overall Structure Condition" {{ in_array('Overall Structure Condition',$visual) ? 'checked' : '' }}>
                Overall Structure Condition
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="visual[]" value="Linkages" {{ in_array('Linkages',$visual) ? 'checked' : '' }}>
                Linkages
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="visual[]" value="Registration Marking Display Properly" {{ in_array('Registration Marking Display Properly',$visual) ? 'checked' : '' }}>
                Registration Marking Display Properly
                </label>
            </div>
          </div>

          <div class="form-group">
            <h4>Control Surface and Motor</h4>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="control[]" value="Propulsion System" {{ in_array('Propulsion System',$control) ? 'checked' : '' }}>
                Propulsion System
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="control[]" value="Propeller Attached Correctly and Secure" {{ in_array('Propeller Attached Correctly and Secure',$control) ? 'checked' : '' }}>
                Propeller Attached Correctly and Secure
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="control[]" value="Check Abnormal Noise" {{ in_array('Check Abnormal Noise',$control) ? 'checked' : '' }}>
                Check Abnormal Noise
                </label>
            </div>
          </div>

          <div class="form-group">
            <h4>Propellers</h4>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="propellers[]" value="Condotions as per Design" {{ in_array('Condotions as per Design',$propellers) ? 'checked' : '' }}>
                Condotions as per Design
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="propellers[]" value="Dent or Cracks" {{ in_array('Dent or Cracks',$propellers) ? 'checked' : '' }}>
                Dent or Cracks
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="propellers[]" value="Correctly Orientation" {{ in_array('Correctly Orientation',$propellers) ? 'checked' : '' }}>
                Correctly Orientation
                </label>
            </div>
          </div>

          <div class="form-group">
            <h4>Power System / Battery</h4>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="power[]" value="Physical Condition" {{ in_array('Physical Condition',$power) ? 'checked' : '' }}>
                Physical Condition
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="power[]" value="Fully Charge / Sufficient for Operation" {{ in_array('Fully Charge / Sufficient for Operation',$power) ? 'checked' : '' }}>
                Fully Charge / Sufficient for Operation
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="power[]" value="Check for Installation" {{ in_array('Check for Installation',$power) ? 'checked' : '' }}>
                Check for Installation
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="power[]" value="No Damage Wiring/Loose" {{ in_array('No Damage Wiring/Loose',$power) ? 'checked' : '' }}>
                No Damage Wiring/Loose
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="power[]" value="Compartement Lid Close/Locked" {{ in_array('Compartement Lid Close/Locked',$power) ? 'checked' : '' }}>
                Compartement Lid Close/Locked
                </label>
            </div>
          </div>

          <div class="form-group">
            <h4>Payload</h4>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="payload[]" value="Memory Card (Micro SD)" {{ in_array('Memory Card (Micro SD)',$payload) ? 'checked' : '' }}>
                Memory Card (Micro SD)
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="payload[]" value="Check Payload Setting" {{ in_array('Check Payload Setting',$payload) ? 'checked' : '' }}>
                Check Payload Setting
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="payload[]" value="Secure Connection and Cables" {{ in_array('Secure Connection and Cables',$payload) ? 'checked' : '' }}>
                Secure Connection and Cables
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="payload[]" value="Check Functionality" {{ in_array('Check Functionality',$payload) ? 'checked' : '' }}>
                Check Functionality
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="payload[]" value="Parachute Recovery (if any)" {{ in_array('Parachute Recovery (if any)',$payload) ? 'checked' : '' }}>
                Parachute Recovery (if any)
                </label>
            </div>
          </div>

          <div class="form-group">
            <h4>GCS / Monitor</h4>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="monitor[]" value="Battery Level" {{ in_array('Battery Level',$monitor) ? 'checked' : '' }}>
                Battery Level
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="monitor[]" value="Cables Correctly Connect" {{ in_array('Cables Correctly Connect',$monitor) ? 'checked' : '' }}>
                Cables Correctly Connect
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="monitor[]" value="Display Functioning Correctly" {{ in_array('Display Functioning Correctly',$monitor) ? 'checked' : '' }}>
                Display Functioning Correctly
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="monitor[]" value="Software Update" {{ in_array('Software Update',$monitor) ? 'checked' : '' }}>
                Software Update
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="monitor[]" value="GCS/Monitor Connected to UAS" {{ in_array('GCS/Monitor Connected to UAS',$monitor) ? 'checked' : '' }}>
                GCS/Monitor Connected to UAS
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="monitor[]" value="Telemetry Reading - All Normal" {{ in_array('Telemetry Reading - All Normal',$monitor) ? 'checked' : '' }}>
                Telemetry Reading - All Normal
                </label>
            </div>
          </div>



          <button type="submit" class="btn btn-primary btn-lg text-light">Submit</button>
          <a href="/inventory/batteries" class="btn btn-danger btn-lg text-light">Cancel</a>

        </form>

      </div>
    </div>
  </div

@endsection
