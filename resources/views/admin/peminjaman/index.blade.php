@extends('dashboard.index')
@section('title','Peminjaman')

@push('css')
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 <!-- Select2 -->
 <link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
 <link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
 <style>
   .select2-selection__choice{
     background: #007bff;
     color: white !important
   }
 </style>
@endpush

@section('content')
 {{-- @role('admin') --}}
 {{-- @can('page_peminjaman') --}}
    <div id="controller">
        <div class="container-fluid">

             {{-- Start - Button  Add Peminjaman  --}}
            <div class="row mb-3">
              <div class="col">
                <button @click="addPeminjaman" data-target="#modalForm" class="btn btn-primary py-2 px-5">Add New Peminjaman</button>
              </div>
            </div>
            {{-- End -  Button Add Peminjaman --}}

            {{-- Start Table Peminjaman --}}
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header ">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-3">
                        <h3 class="card-title">Responsive Hover Table</h3>
                      </div>
                      <div class="col d-flex align-items-center justify-content-end">
                          <div class="row  ">
                            <div class="col-4 align-self-end">
                              <select name="status" id="" class="custom-select">
                                <option value="0">Status</option>
                                <option value="belum">Belum</option>
                                <option value="sudah">Sudah</option>
                              </select>
                            </div>
                            <div class="col">
                              <label for="tgl_pinjam">Filter Tanggal Pinjam</label>
                              <div class="input-group">
                                <input type="date" id="tgl_pinjam" name="tgl_pinjam" value="" class="form-control">
                                <span class="input-group-append">
                                  <button type="button" class="btn btn-info btn-flat" onclick="resetDate()"><i class="fas fa-search"></i></button>
                                </span>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body  ">
                    <table id="datatable" class="table table-hover table-striped ">
                      <thead>
                        <tr>  
                          <th>Tanggal Pinjam</th>
                          <th>Tanggal Kembali</th>
                          <th>Nama</th>
                          <th>Lama Pinjam</th>
                          <th>Total Buku</th>
                          <th>Total Bayar</th>
                          <th>Status</th>
                          <th class="text-center" style="width: 20%">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            {{-- End Table Peminjaman --}}

            {{-- Start Modal --}}
            <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col">

                          <form :action="actionUrl" method="POST" @submit.prevent="submitForm($event,data.id)">
                            {{-- Token --}}
                            <template v-if="!editStatus">
                                @csrf
                            </template>

                            <template v-if="editStatus">
                              @csrf
                              @method('put')
                          </template>
                          {{-- End Token --}}

                            {{-- Start Input Anggota --}}
                            <div class="form-group row">
                              <label for="id_anggota" class="col-sm-3 col-form-label">Anggota</label>
                              <div class="col-sm-9">
                                <select name="id_anggota" id="" class="custom-select">
                                  <option value="">Pilih Anggota</option>
                                  @foreach ($anggotas as $anggota)
                                  <option :selected="data.id_anggota === {{ $anggota->id }}"  value="{{ $anggota->id }}">{{ $anggota->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          {{-- End Input Anggota --}}

                          {{-- Start Input Tanggal Peminjaman --}}
                            <div class="form-group row">
                              <label for="tgl_pinjam" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                              <div class="col-sm-9">
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" :value="data.tgl_pinjam" >
                              </div>
                            </div>
                          {{-- End Input Tanggal Peminjaman --}}

                          {{-- Start Input Tanggal kembali --}}
                              <div class="form-group row">
                                <label for="tgl_kembali" class="col-sm-3 col-form-label">Tanggal Kembali</label>
                                <div class="col-sm-9">
                                  <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" :value="data.tgl_kembali" >
                                </div>
                              </div>
                          {{-- End Input Tanggal kembali --}}

                          {{-- Start Input Buku --}}
                            <div class="form-group row">
                              <label for="id_buku" class="col-sm-3 col-form-label">Buku</label>
                              <div class="col-sm-9">
                                <select name="id_buku[]" id="select2" class="select2" multiple="multiple" data-placeholder="Pilih Buku" style="width: 100%"> 
                                  
                                </select>
                              </div>
                            </div>
                          {{-- End Input Buku --}}


                          <template v-if="editStatus">
                            <div class="form-group row align-items-center">
                                <label for="" class="col-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                      <div class="col-2">
                                        <div class="custom-control custom-radio">
                                          <input :checked="data.status === 'belum'" class="custom-control-input" type="radio" id="belum" value="belum" name="status">
                                          <label for="belum" class="custom-control-label">Belum</label>
                                        </div>
                                      </div>
                                      <div class="col-2">
                                        <div class="custom-control custom-radio">
                                          <input :checked="data.status === 'sudah'" class="custom-control-input" type="radio" id="sudah" value="sudah" name="status">
                                          <label for="sudah" class="custom-control-label">Sudah</label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          </template>

                          {{-- Button Submit --}}
                            <div class="form-gorup">
                              <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-2 px-5">Submit</button>
                              </div>
                            </div>
                          {{-- End Button Submit --}}

                          </form>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- End Modal --}}

            {{-- Start Modal Detail Peminjaman  --}}
              <div class="modal fade" id="detailPeminjamanModal" tabindex="-1" aria-labelledby="detailPeminjamanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="detailPeminjamanModalLabel">Detail Peminjaman</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col">
                            {{-- Detail Nama Peminjam --}}
                            <div class="form-group row align-items-center">
                              <div class="col-sm-4 col-form-label font-weight-bold">Nama Anggota</div>
                              <div class="col-sm-8">
                                <div>: @{{ anggota.name }}</div>
                              </div>
                            </div>
                            {{-- End Detail Nama Peminjam --}}

                            {{-- Detail Tanggal Pinjam --}}
                            <div class="form-group row align-items-center">
                              <div class="col-sm-4 col-form-label font-weight-bold">Tanggal Pinjam</div>
                              <div class="col-sm-8">
                                <div>: @{{ data.tgl_pinjam }}</div>
                              </div>
                            </div>
                            {{-- EndDetail Tanggal Pinjam --}}

                             {{-- Detail Buku --}}
                             <div class="form-group row align-items-center">
                              <div class="col-sm-4 col-form-label  font-weight-bold align-self-start">Buku</div>
                              <div class="col-sm-8">
                                <ul class="list-group">
                                  <li v-for="buku of bukus" class="list-group-item" :key="buku.id">@{{ buku.judul }}</li>
                              </div>
                            </div>
                            {{-- EndDetail Buku --}}

                                   {{-- Detail Status --}}
                                   <div class="form-group row align-items-center">
                                    <div class="col-sm-4 col-form-label font-weight-bold">Status</div>
                                    <div class="col-sm-8">
                                      <div>: @{{ data.status === 'sudah' ? 'Sudah Kembali' : 'Belum Kembali' }}</div>
                                    </div>
                                  </div>
                                  {{-- EndDetail Status --}}

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            {{-- End Modal Detail Peminjaman  --}}
      </div>
    </div>
  {{-- @endcan --}}
  {{-- @endrole --}}
@endsection

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>

{{-- Datatable Peminjaman --}}
<script>
    let bukus = `{!! json_encode($bukus) !!}`;
    let actionUrl = `{{ url('data/peminjaman') }}`;
    let columns = [
      {data : 'tgl_pinjam'},
      {data : 'tgl_kembali'}, 
      {render : (index,row,data,meta) => data.anggota.name },
      {data: 'lama_pinjam'},
      {render : (index,row,data,meta) => data.buku.length },
      {data: 'total_bayar'},
      {data: 'status'},
      {
        render: function(index,row,data,meta){
          return `
            <button class="badge badge-success btn border-0" onclick="controller.editPeminjaman(${meta.row})">Edit</button>
            <button class="badge badge-primary btn border-0" onclick="controller.detailPeminjaman(${meta.row})">Detail</button>
            <button class="badge badge-danger btn border-0" onclick="controller.deleteData(event,${data.id})">Delete</button>
          `
        }, class: 'text-center'
      }
    ];
</script>
<script src="{{ asset('js/data.js') }}"></script>
<script>

  function resetDate(){
    let tgl_pinjam = $('input[name=tgl_pinjam]').val();
    let status = $('select[name=status]').val();
    $('input[name=tgl_pinjam]').val('');

    controller.table.ajax.url(`${actionUrl}?status=${status}`).load();
    console.log('koo');
    
    // if(status === "0" && tgl_pinjam === ""){
    //   // controller.table.ajax.url(actionUrl).load();
    // } else if(status !== "0" && tgl_pinjam == ""){
    //   controller.table.ajax.url(`${actionUrl}?status=${status}`).load();
    // } else if(status === "0" && tgl_pinjam === ""){
    //   controller.table.ajax.url(`${actionUrl}?tgl_pinjam=${tgl_pinjam}`).load();
    // }

    
  }

  $(function(){


    $('.select2').select2({
      theme: 'bootstrap4'
    })

    $('select[name=status]').on('change',function(){
      if(status === '0'){
        controller.table.ajax.url(actionUrl).load()
      } else {
        let tgl_pinjam = $('input[name=tgl_pinjam]').val();
        let status = $('select[name=status]').val();
        controller.table.ajax.url(`${actionUrl}?status=${status}&tgl_pinjam=${tgl_pinjam}`).load()
      }
    });

    $('input[name=tgl_pinjam]').on('change',function(){
      if(tgl_pinjam === null){
        controller.table.ajax.url(actionUrl).load();
      }

      if(tgl_pinjam !== null){
        let tgl_pinjam = $('input[name=tgl_pinjam]').val();
        let status = $('select[name=status]').val();
        controller.table.ajax.url(`${actionUrl}?status=${status}&tgl_pinjam=${tgl_pinjam}`).load();
      }
    })

  });

</script>
@endpush
