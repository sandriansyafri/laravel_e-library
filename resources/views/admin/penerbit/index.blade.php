@extends('dashboard.index')
@section('title','Penerbit')

@push('css')
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
    <div id="controller">
        <section class="content">
            <div class="container-fluid">

              <div class="row mb-3">
                <div class="col-md-3">
                    <button v-on:click="addData"   type="button" class="btn btn-primary py-2 w-100" data-toggle="modal" data-target="#modalForm">Add New Penerbit</button>
                </div>
            </div>
           
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Penerbits</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="datatable" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th class="text-center">Penerbit</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Telp</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                {{-- <tbody>
                                 @forelse ($penerbits as $penerbit)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $penerbit->nama_penerbit }}</td>
                                        <td class="text-center">{{ $penerbit->email }}</td>
                                        <td class="text-center">{{ $penerbit->telp }}</td>
                                        <td class="text-center">{{ $penerbit->alamat }}</td>
                                        <td class="text-center">
                                            <button @click.prevent="editData({{ $penerbit }})"  class="btn badge badge-warning ">
                                                <i class="far fa-edit" ></i>
                                                Edit
                                            </button>
                                            <form action="{{ route('penerbit.destroy',$penerbit->id) }}" method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <button @click.prevent="deleteData({{ $penerbit->id }})" type="submit" class="btn badge badge-danger">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                 @empty
                                     
                                 @endforelse
                                
                                </tbody> --}}
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </div>
                </div>
            </div>
        </section>

          <!-- Modal -->
      <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">

              <template v-if="!editStatus">
                <h5 class="modal-title" id="modalFormLabel">Add New Penerbit</h5>
              </template>

              <template v-if="editStatus">
                <h5 class="modal-title" id="modalFormLabel">Edit New Penerbit</h5>
              </template>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" :action="actionUrl" @submit.prevent="submitForm($event,data.id)">
                <div class="modal-body">
                      <template v-if="!editStatus">
                        @csrf
                      </template>

                      <template v-if="editStatus">
                        @csrf
                        @method('put')
                      </template>
                  <div class="card-body">

                    <div class="form-group">
                      <label for="penerbit">Nama Penerbit</label>
                      <input 
                        :value="data.nama_penerbit"
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
                          :value="data.email"
                          type="email" 
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
                          :value="data.telp"
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
                          :value="data.alamat"
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
                        <button type="submit" class="btn btn-primary w-100 py-3 d-inline-block">Submit</button>
                    </div>
                  </div>
                  <!-- /.card-body -->
            </div>
        </form>
          </div>
        </div>
      </div>

    </div>
@endsection

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script>
  var actionUrl = `{{ route('penerbit.index') }}`;
  var columns =  [
          {data: 'nama_penerbit', class: 'text-center',orderable: true},
          {data: 'email', class: 'text-center',orderable: true},
          {data: 'telp', class: 'text-center',orderable: true},
          {data: 'alamat', class: 'text-center',orderable: true},
          {
            render : function(index,row,data,meta){
              return `
                <button onclick="controller.editData(event, ${meta.row})" type="button"  class="btn badge badge-warning">
                  <i class="far fa-edit"></i>
                  Edit
                  </button>
                <button onclick="controller.deleteData(event, ${data.id})" type="button" class="btn badge badge-danger">
                  <i class="fas fa-trash"></i>
                   Delete 
                  </button>
              `;
            }, orderable: false, class: 'text-center'
          }
        ]
</script>
<script src="{{ asset('js/data.js') }}"></script>
@endpush
