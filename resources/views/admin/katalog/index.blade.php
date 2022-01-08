@extends('dashboard.index')
@section('title','Katalog')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-3">
                    <a href="{{ route('katalog.create') }}" class="btn btn-primary py-2 w-100">Add New Katalog</a>
                </div>
            </div>
       
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Katalogs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="text-center" style="width: 60%">Katalog</th>
                                <th class="text-center" style="width: 30%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                             @forelse ($katalogs as $katalog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $katalog->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('katalog.edit',$katalog->id) }}" class="badge badge-warning ">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('katalog.destroy',$katalog->id) }}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn badge badge-danger">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                             @empty
                                 
                             @endforelse
                            
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </section>
@endsection