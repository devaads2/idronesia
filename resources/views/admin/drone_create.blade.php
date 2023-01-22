@extends('templates.main')

@section('content')
    
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>

        <form class="forms-sample" action="/inventory/drone/insert" method="POST" enctype="multipart/form-data">
            @csrf

          <div class="form-group">
            <label for="exampleInputName1">Item Name</label>
            <input type="text" class="form-control @error('drone_name') is-invalid @enderror" placeholder="Item Name" name="drone_name" value="{{ old('drone_name') }}">
                <div class="invalid-feedback">
                    @error('drone_name')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Max. Flying Altitude</label>
            <input type="text" class="form-control @error('max_flying_alt') is-invalid @enderror" placeholder="Max. Flying Altitude" name="max_flying_alt" value="{{ old('max_flying_alt') }}">
                <div class="invalid-feedback">
                    @error('max_flying_alt')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Adjustable Angel Camera</label>
            <input type="text" class="form-control @error('adjustable_angel_camera') is-invalid @enderror" placeholder="Adjustable Angel Camera" name="adjustable_angel_camera" value="{{ old('adjustable_angel_camera') }}">
            <div class="invalid-feedback">
                @error('adjustable_angel_camera')
                {{ $message }}
                @enderror
            </div>
        </div>

          <div class="form-group">
            <label for="exampleInputName1">EIS</label>
            <input type="text" class="form-control @error('eis') is-invalid @enderror" placeholder="EIS" name="eis" value="{{ old('eis') }}">
            <div class="invalid-feedback">
                @error('eis')
                {{ $message }}
                @enderror
            </div>
        </div>

          <div class="form-group">
            <label for="exampleInputName1">Control Distance</label>
            <input type="text" class="form-control @error('control_distance') is-invalid @enderror" placeholder="Control Distance" name="control_distance" value="{{ old('control_distance') }}">
            <div class="invalid-feedback">
                @error('control_distance')
                {{ $message }}
                @enderror
            </div>
        </div>

          <div class="form-group">
            <label for="exampleInputName1">Wifi Transmission</label>
            <input type="text" class="form-control @error('wifi_transmission') is-invalid @enderror" placeholder="Wifi Transmission" name="wifi_transmission" value="{{ old('wifi_transmission') }}">
            <div class="invalid-feedback">
                @error('wifi_transmission')
                {{ $message }}
                @enderror
            </div>
        </div>

          <div class="form-group">
            <label for="exampleInputName1">Video Resolution</label>
            <input type="text" class="form-control @error('video_res') is-invalid @enderror" placeholder="Video Resolution" name="video_res" value="{{ old('video_res') }}">
            <div class="invalid-feedback">
                @error('video_res')
                {{ $message }}
                @enderror
            </div>
        </div>

          <div class="form-group">
            <label for="exampleInputName1">Photo Resolution</label>
            <input type="text" class="form-control @error('photo_res') is-invalid @enderror" placeholder="Photo Resolution" name="photo_res" value="{{ old('photo_res') }}">
            <div class="invalid-feedback">
                @error('photo_res')
                {{ $message }}
                @enderror
            </div>
        </div>

          <div class="form-group">
            <label for="exampleInputName1">Product Weight</label>
            <input type="text" class="form-control @error('product_weight') is-invalid @enderror" placeholder="Product Weight" name="product_weight" value="{{ old('product_weight') }}"> 
            <div class="invalid-feedback">
                @error('product_weight')
                {{ $message }}
                @enderror
            </div>
        </div>

          <div class="form-group">
            <label for="exampleInputName1">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
            <div class="invalid-feedback">
                @error('image')
                {{ $message }}
                @enderror
            </div>
        </div>

          <button type="submit" class="btn btn-primary btn-lg text-light">Submit</button>
          <a href="/inventory/drone" class="btn btn-danger btn-lg text-light">Cancel</a>

        </form>

      </div>
    </div>
  </div

@endsection