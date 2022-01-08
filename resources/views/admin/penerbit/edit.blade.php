@extends('dashboard.index')

@section('title','Create New Penerbit')

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
                        <form method="POST" action="{{ route('penerbit.update',$penerbit->id) }}">
                            @csrf
                            @method('put')
                          <div class="card-body">

                            <div class="form-group">
                              <label for="penerbit">Nama Penerbit</label>
                              <input 
                              value="{{ $penerbit->nama_penerbit }}"
                                type="text" 
                                class="form-control @error('nama_penerbit') is-invalid @enderror" 
                                id="penerbit" 
                                name="nama_penerbit">

                                @error('nama_penerbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input 
                                  value="{{ $penerbit->email }}"
                                  type="text" 
                                  class="form-control @error('email') is-invalid @enderror" 
                                  id="email" 
                                  name="email">
  
                                  @error('email')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                                  @enderror
                              </div>

                              <div class="form-group">
                                <label for="telp">Telp</label>
                                <input 
                                  value="{{ $penerbit->telp }}"
                                  type="text" 
                                  class="form-control @error('telp') is-invalid @enderror" 
                                  id="telp" 
                                  name="telp">
  
                                  @error('telp')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                                  @enderror
                              </div>

                              <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input 
                                  value="{{ $penerbit->alamat }}"
                                  type="text" 
                                  class="form-control @error('alamat') is-invalid @enderror" 
                                  id="alamat" 
                                  name="alamat">
  
                                  @error('alamat')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                                  @enderror
                              </div>

                            <div class="form-group">
                                <button class="btn btn-secondary px-5 py-2 d-inline-block">Update</button>
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