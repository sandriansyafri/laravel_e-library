@extends('dashboard.index')
@section('title','Anggota')

@push('css')
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
    <div id="controller">
        <section class="content">
            <div class="container-fluid">

              <div class="row mb-3 align-items-center justify-content-between">
                <div class="col-md-3">
                    <button v-on:click="addData"   type="button" class="btn btn-primary py-2 w-100" data-toggle="modal" data-target="#modalForm">Add New Anggota</button>
                </div>
                <div class="col-md-3 ml-auto">
                  <select class="custom-select" name="sex">
                    <option value="0">Jenis Kelamin</option>
                    <option value="L">Laki Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
            </div>
           
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Anggotas</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="datatable" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Sex</th>
                                    <th class="text-center">Telp</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Email</th>
                                    <th style="width: 20%" class="text-center">Action</th>
                                  </tr>
                                </thead>
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
                <h5 class="modal-title" id="modalFormLabel">Add New Anggota</h5>
              </template>

              <template v-if="editStatus">
                <h5 class="modal-title" id="modalFormLabel">Edit New Anggota</h5>
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
                      <label for="name">ANGGOTA</label>
                      <input 
                        :value="data.name"
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="anggota" 
                        name="name">

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="sex">SEX</label>
                      <select class="custom-select" name="sex">
                        <option :selected="data.sex === 'L'" value="L">LAKI LAKI</option>
                        <option :selected="data.sex === 'P'" value="P">PEREMPUAN</option>
                     
                      </select>

                        @error('sex')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="telp">TELP</label>
                      <input 
                        :value="data.telp"
                        type="text" 
                        class="form-control @error('telp') is-invalid @enderror" 
                        id="anggota" 
                        name="telp">

                        @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="alamat">ALAMAT</label>
                      <input 
                        :value="data.alamat"
                        type="text" 
                        class="form-control @error('alamat') is-invalid @enderror" 
                        id="anggota" 
                        name="alamat">

                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="email">EMAIL</label>
                      <input 
                        :value="data.email"
                        type="text" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="anggota" 
                        name="email">

                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <template v-if="!editStatus">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100 py-3 d-inline-block">Submit
                      </button>
                    </template>

                    <template v-if="editStatus">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100 py-3 d-inline-block">Update
                      </button>
                    </template>
                    

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
  var actionUrl = `{{ url('data/anggota') }}`;
  var columns =  [
          {data: 'name', class: 'text-center',orderable: true},
          {data: 'sex', class: 'text-center',orderable: true},
          {data: 'telp', class: 'text-center',orderable: true},
          {data: 'alamat', class: 'text-center',orderable: true},
          {data: 'email', class: 'text-center',orderable: true},
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
<script>

  $('select[name=sex]').on('change',function(){
    let sex = $('select[name=sex]').val();

    if(sex === "0" ){
      controller.table.ajax.url(actionUrl).load();
    } else {
      controller.table.ajax.url(`${actionUrl}?sex=${sex}`).load();
    }

  })

</script>
@endpush
