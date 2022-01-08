@extends('dashboard.index')

@section('title','Create New Katalog')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-secondary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('katalog.store') }}">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="katalog">Katalog</label>
                              <input 
                                value="{{ old('name') }}" 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="katalog" 
                                name="name">

                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-secondary px-5 py-2 d-inline-block">Submit</button>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </section>
@endsection