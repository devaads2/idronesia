@extends('templates.main')

@section('content')
    
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>

        <form class="forms-sample" action="/inventory/batteries/insert" method="POST" enctype="multipart/form-data">
            @csrf

          <div class="form-group">
            <label for="exampleInputName1">Item Name</label>
            <input type="text" class="form-control @error('batteries_name') is-invalid @enderror" placeholder="Item Name" name="batteries_name" value="{{ old('batteries_name') }}">
                <div class="invalid-feedback">
                    @error('batteries_name')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Type Battery</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" placeholder="Type Battery" name="type" value="{{ old('type') }}">
                <div class="invalid-feedback">
                    @error('type')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Long Battery Life</label>
            <input type="text" class="form-control @error('long_life') is-invalid @enderror" placeholder="Long Battery Life" name="long_life" value="{{ old('long_life') }}">
                <div class="invalid-feedback">
                    @error('long_life')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Battery Capacity</label>
            <input type="text" class="form-control @error('capacity') is-invalid @enderror" placeholder="Battery Capacity" name="capacity" value="{{ old('capacity') }}">
                <div class="invalid-feedback">
                    @error('capacity')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Lithium Battery Voltage</label>
            <input type="text" class="form-control @error('voltage') is-invalid @enderror" placeholder="Lithium Battery Voltage" name="voltage" value="{{ old('voltage') }}">
                <div class="invalid-feedback">
                    @error('voltage')
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
          <a href="/inventory/batteries" class="btn btn-danger btn-lg text-light">Cancel</a>

        </form>

      </div>
    </div>
  </div

@endsection