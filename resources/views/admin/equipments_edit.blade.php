@extends('templates.main')

@section('content')
    
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>

        <form class="forms-sample" action="/inventory/equipments/update/{{ $equipments->id }}" method="POST" enctype="multipart/form-data">
            @csrf

          <div class="form-group">
            <label for="exampleInputName1">Item Name</label>
            <input type="text" class="form-control @error('equipments_name') is-invalid @enderror" placeholder="Item Name" name="equipments_name" value="{{ $equipments->equipments_name }}">
                <div class="invalid-feedback">
                    @error('equipments_name')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Equipments Type</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" placeholder="Equipments Type" name="type" value="{{ $equipments->type }}">
                <div class="invalid-feedback">
                    @error('type')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Description</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description" value="{{ $equipments->description }}">
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
          <a href="/inventory/equipments" class="btn btn-danger btn-lg text-light">Cancel</a>

        </form>

      </div>
    </div>
  </div

@endsection