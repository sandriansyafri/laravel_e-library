@extends('dashboard.index')
@section('title','Pengarang')

@section('content')
   <component id="controller">
      <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-md-3">
                    <button @click="addData()"  type="button" class="btn btn-primary py-2 w-100" data-toggle="modal" data-target="#modalPengarang">Add New Pengarang</button>
                </div>
            </div>
      
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Pengarangs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="text-center">Pengarang</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Telp</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @forelse ($pengarangs as $pengarang)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $pengarang->nama_pengarang }}</td>
                                    <td class="text-center">{{ $pengarang->email }}</td>
                                    <td class="text-center">{{ $pengarang->telp }}</td>
                                    <td class="text-center">{{ $pengarang->alamat }}</td>
                                    <td class="text-center">
                                        <button @click="editData({{ $pengarang }})"  class="btn badge badge-warning ">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </button>
                                        <form  action="{{ route('pengarang.destroy', $pengarang->id) }}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button @click.prevent="deleteData({{ $pengarang->id }})"  type="submit" class="btn badge badge-danger">
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
  <!-- Modal -->
      <div class="modal fade" id="modalPengarang" tabindex="-1" aria-labelledby="modalPengarangLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">

              <template v-if="!editStatus">
                <h5 class="modal-title" id="modalPengarangLabel">Add New Pengarang</h5>
              </template>

              <template v-if="editStatus">
                <h5 class="modal-title" id="modalPengarangLabel">Edit New Pengarang</h5>
              </template>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" :action="actionForm">
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
                      <label for="pengarang">Nama Pengarang</label>
                      <input 
                        :value="formData.nama_pengarang" 
                        type="text" 
                        class="form-control @error('nama_pengarang') is-invalid @enderror" 
                        id="pengarang" 
                        name="nama_pengarang">

                        @error('nama_pengarang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                          :value="formData.email" 
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
                          :value="formData.telp" 
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
                          :value="formData.alamat" 
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
                        <button class="btn btn-primary w-100 py-3 d-inline-block">Submit</button>
                    </div>
                  </div>
                  <!-- /.card-body -->
            </div>
        </form>
          </div>
        </div>
      </div>
   </component>
@endsection

@push('js')
      <script>
            const controller = new Vue({
              el : '#controller',
              data : {
                editStatus: false,
                formData : {},
                actionForm : ''
              },
              methods:{
                addData(){
                  this.editStatus = false;
                  this.formData = {};
                  this.actionForm = '{{ url('data/pengarang') }}';
                    $('#modalPengarang').modal();
                  },
                  editData(pengarang){
                    const id = pengarang.id;
                    this.editStatus = true;
                    this.formData = pengarang;
                    this.actionForm = '{{ url('data/pengarang') }}' + '/' + id;
                    $('#modalPengarang').modal();
                },
                deleteData(id){

                    this.actionForm = '{{ url('data/pengarang') }}' + '/' + id;
                    if(confirm('Delete data?')){
                        axios.post(this.actionForm, {
                            _method: 'DELETE'
                        }).then(res => {
                          location.reload();
                        });
                    }
                }
              
              }
            })
      </script>
@endpush