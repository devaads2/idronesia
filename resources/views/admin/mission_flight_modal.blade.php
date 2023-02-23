<div class="modal fade text-left" id="categoryModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="categoryForm" name="categoryForm"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="mission_flight_id" name="mission_flight_id" value="">
                    <div class="form-group">
                        <label for="mission_flight_name">Mission Flight</label>
                        <input type="text" class="form-control @error('mission_flight_name') is-invalid @enderror"
                               placeholder="Mission Flight" id= "mission_flight_name" name="mission_flight_name" value="{{ old('mission_flight') }}">
                        <div class="invalid-feedback">
                            @error('mission_flight')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-block btn-primary text-white" id="saveBtn"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
