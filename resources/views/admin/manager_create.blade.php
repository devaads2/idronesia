@extends('templates.main')

@section('content')
    
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>

        <form class="forms-sample" action="/user/insert" method="POST" enctype="multipart/form-data">
            @csrf

          <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}">
                <div class="invalid-feedback">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="email" name="email" value="{{ old('email') }}">
                <div class="invalid-feedback">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="address" name="address" value="{{ old('address') }}">
                <div class="invalid-feedback">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="phone" name="phone" value="{{ old('phone') }}">
                <div class="invalid-feedback">
                    @error('phone')
                    {{ $message }}
                    @enderror
                </div>
          </div>

          <div class="col">
            <div class="form-group">
                <label for="exampleInputName1">Select User Level</label>
                <select class="form-select form-select-sm @error('level') is-invalid @enderror" name="level">
                  <option value="">----- SELECT USER LEVEL -----</option>
                  <option value="admin">Admin</option>
                  <option value="manager">Manager</option>
                  <option value="pilot">Pilot</option>
                </select>
                <div class="invalid-feedback">
                  @error('level')
                  {{ $message }}
                  @enderror
              </div>
              </div>        
        </div>

          <div class="form-group">
            <label for="exampleInputName1">password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" value="{{ old('password') }}">
                <div class="invalid-feedback">
                    @error('password')
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