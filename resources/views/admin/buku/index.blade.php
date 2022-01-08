@extends('dashboard.index')
@section('title','Buku')

@section('content')
    <div id="controller">
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">
                        <button @click="addData()" data-toggle="modal" data-target="#formModal" type="button" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input v-model="keywords" autocomplete="off" type="search" class="form-control form-control-lg" placeholder="Cari Buku Berdasarkan Judul">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <template v-for="data in filterBuku" key="data.id">
                    <div class="col col-md-4">
                            <div class="card my-2">
                                <div class="card-body">
                                    <table cellpadding="5px">
                                        <thead>
                                            <tr>
                                                <td class="text-sm"><strong>ISBN</strong></td>
                                                <td class="text-sm"> : @{{ data.isbn }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm"><strong>Judul</strong></td>
                                                <td class="text-sm"> : @{{ data.judul }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm"><strong>Penerbit</strong></td>
                                                <td class="text-sm"> : @{{ data.penerbit.nama_penerbit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm"><strong>Pengarang</strong></td>
                                                <td class="text-sm"> : @{{ data.pengarang.nama_pengarang }}</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button @click="editData(data)" class="btn btn-primary w-100 mb-2">Detail</button>
                                    <form :action="actionUrl" class="d-inline-block w-100" method="POST" >
                                           <template v-if="deleteStatus">
                                            @csrf
                                            @method('delete')
                                        </template>
                                        <button type="submit" @click="deleteData(data.id)" class="btn btn-danger w-100 py-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>
        
        <!-- Modal -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Detail Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card-body p-0">
                                    <form :action="actionUrl" method="POST">

                                        <template v-if="!editStatus">
                                            @csrf
                                        </template>

                                        <template v-if="editStatus">
                                            @csrf
                                            @method('put')
                                        </template>

                                     

                                        <div class="form-group">
                                            <label for="">ISBN</label>
                                            <input :value="data.isbn" name="isbn" type="text" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Judul</label>
                                            <input :value="data.judul"  name="judul" type="text" class="form-control">
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="">Tahun</label>
                                            <input :value="data.tahun" name="tahun" type="text" class="form-control ">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input :value="data.qty_stok" name="qty_stok" type="text" class="form-control ">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Harga Pinjam</label>
                                            <input :value="data.harga_pinjam" name="harga_pinjam" type="text" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Penerbit</label>
                                            <select name="id_penerbit" id="" class="form-control">
                                                <option value="">SELECT</option>
                                                @foreach ($penerbits as $penerbit)
                                                    <option :selected="data.id_penerbit== {{ $penerbit->id }}" value="{{ $penerbit->id }}">
                                                        {{ $penerbit->nama_penerbit }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Pengarang</label>
                                            <select name="id_pengarang" id="" class="form-control">
                                                <option value="">SELECT</option>
                                                @foreach ($pengarangs as $pengarang)
                                                    <option :selected="data.id_pengarang== {{ $pengarang->id }}" value="{{ $pengarang->id }}">
                                                        {{ $pengarang->nama_pengarang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Katalog</label>
                                            <select name="id_katalog" id="" class="form-control">
                                                <option value="">SELECT</option>
                                                @foreach ($katalogs as $katalog)
                                                    <option :selected="data.id_katalog== {{ $katalog->id }}" value="{{ $katalog->id }}">
                                                        {{ $katalog->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                       
                                        <template v-if="!editStatus">
                                            <button type="submit" class="w-100 btn btn-primary">Tambah Data</button>
                                        </template>
                                        <template v-if="editStatus">
                                            <button type="submit" class="w-100 btn btn-primary">Update Data</button>
                                        </template>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        let actionUrl = `{{ route('buku.index') }}`
        const controller = new Vue({
            el : '#controller',
            data : {
                keywords : '',
                datas : [],
                data : {},
                actionUrl: actionUrl,
                editStatus : false,
                deleteStatus : false
            },
            mounted(){
                this.getBukus();
            },
            methods : {
                submitForm(id){
                    var actionUrl = !editStatus ? `${this.actionUrl}` : `${this.actionUrl}/${id}`;
                },
                addData(){
                    this.editStatus = false;
                    this,actionUrl = this.actionUrl;
                    this.data = {};
                },
                editData(data){
                    this.editStatus = true;
                    this.data = data;
                    this.actionUrl = `{{ url('data/buku/${data.id}') }}`;
                    $("#formModal").modal();
                },
                deleteData(id){
                    this.deleteStatus = true;
                    this.actionUrl = `{{ url('data/buku/${id}') }}`;
            
                },
                getBukus(){
                    const _this = this;
                    $.ajax({
                        url : _this.actionUrl,
                        method : 'GET',
                        success : function(data){
                            _this.datas = JSON.parse(data)
                        },
                        error : function(e){
                            console.log(e);
                        }
                    });
                }
            },
            computed: {
                filterBuku(){
                    return this.datas.filter(data => {
                        return data.judul.toLowerCase().includes(this.keywords.toLowerCase());
                    });
                }
            }
        })
    </script>
@endpush