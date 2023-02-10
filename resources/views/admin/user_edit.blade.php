@extends('templates.main')

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>

                <form class="forms-sample" action="/user/update/{{$user->id}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                               name="name" value="{{ $user->name }}">
                        <div class="invalid-feedback">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="email"
                               name="email" value="{{ $user->email }}">
                        <div class="invalid-feedback">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                               placeholder="address" name="address" value="{{ $user->address }}">
                        <div class="invalid-feedback">
                            @error('address')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="phone"
                               name="phone" value="{{ $user->phone }}">
                        <div class="invalid-feedback">
                            @error('phone')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputName1">Select User Level</label>
                            <select class="form-select form-select-sm @error('level') is-invalid @enderror"
                                    name="level">
                                <option value="admin" {{($user->level == "admin") ? 'selected' : ''}}>Admin</option>
                                <option value="manager" {{($user->level == "manager") ? 'selected' : ''}}>Manager
                                </option>
                                <option value="pilot" {{($user->level == "pilot") ? 'selected' : ''}}>Pilot</option>
                            </select>
                            <div class="invalid-feedback">
                                @error('level')
                                {{ $message }}
                                @enderror
                            </div>
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

                    <a href="/user" class="btn btn-danger btn-lg text-light">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-lg text-light">Submit</button>

                </form>

            </div>
        </div>
    </div

@endsection
