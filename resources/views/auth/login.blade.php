@extends('layouts.app')

@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card  shadow-md">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>PUSTAKA</b>KU</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form action="{{ route('login') }}" method="post">
            @csrf
          <div class="input-group mb-3">
              <input value="{{ old('email') }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
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
            <input value="{{ old('password') }}" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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
          <div class="row align-items-center">

            <div class="col">
              <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
              </p>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
@endsection
