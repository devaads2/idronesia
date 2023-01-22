@extends('templates.main')

@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>

        <form class="forms-sample" action="/inventory/kits/insert" method="POST" enctype="multipart/form-data">
            @csrf

          <div class="form-group">
            <label for="exampleInputName1">Item Name</label>
            <input type="text" class="form-control @error('kits_name') is-invalid @enderror" placeholder="Item Name" name="kits_name" value="{{ old('kits_name') }}">
                <div class="invalid-feedback">
                    @error('kits_name')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Kits Type</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" placeholder="Equipments Type" name="type" value="{{ old('type') }}">
                <div class="invalid-feedback">
                    @error('type')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Description</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description" value="{{ old('description') }}">
                <div class="invalid-feedback">
                    @error('description')
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
          <a href="/inventory/kits" class="btn btn-danger btn-lg text-light">Cancel</a>

        </form>

      </div>
    </div>
  </div

@endsection
