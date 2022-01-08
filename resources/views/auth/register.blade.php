@extends('layouts.app')

@section('content')
<div class="register-box">
    <div class="card shadow-md">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>PUSTAKA</b>KU</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>
  
        <form action="{{ route('register') }}" method="post">
            @csrf
          <div class="input-group mb-3">
            <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror

          </div>
          <div class="input-group mb-3">
            <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>

            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror

          </div>
          <div class="input-group mb-3">
            <input name="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>

            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror

          </div>
          <div class="input-group mb-3">
            <input name="password_confirmation"  type="password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>

            @error('password_confirm')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror

          </div>
          <div class="row align-items-center">
              <div class="col">
                 <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
              </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
  
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
@endsection
