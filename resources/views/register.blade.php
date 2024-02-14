@extends('layouts.navbar')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-5">
        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Registration</h1>
            <form action="/register" method="post">
              @csrf
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                <label for="name">Name</label>
                @error('name')
                    <div class="invalid-feedback">
                        Name must be 3-40 letters long and must be unique
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        Email must contain @gmail.com and must be unique
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                        Password must be 6-12 letters long
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" name="phoneNumber" class="form-control rounded-bottom @error('phoneNumber') is-invalid @enderror" id="phoneNumber" placeholder="Password" required value="{{ old('phoneNumber') }}">
                <label for="phoneNumber">Phone Number</label>
                @error('phoneNumber')
                    <div class="invalid-feedback">
                        Phone Number must start with 08 and only contain digits
                    </div>
                @enderror
              </div>
          
              <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already registered? <a href="/">Login</a></small>
          </main>
    </div>
</div>


@endsection