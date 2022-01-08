const controller = new Vue({
    el: '#controller',
    data: {
        actionUrl: actionUrl,
        editStatus: false,
        data: {},
        anggota: {},
        bukus: {},
        datas: []
    },
    mounted() {
        this.datatable();
    },
    methods: {
        datatable() {
            const _this = this;
            _this.table = $('#datatable').on('xhr.dt', function (e, settings, json, xhr) {
                _this.datas = json.data;
            }).DataTable({
                columns: columns,
                ajax: {
                    url: this.actionUrl,
                    type: 'get'
                },
            })
        },
        addData() {
            this.editStatus = false;
            this.data = {};
            $('#modalForm').modal();
        },
        editData(e, index) {
            this.editStatus = true;
            this.data = this.datas[index];
            $('#modalForm').modal();
        },
        addPeminjaman() {
            this.editStatus = false;
            this.data = {};
            $('#select2').empty();

            let option = ``;
            JSON.parse(bukus).map(buku => {
                return option += `
                <option value="${buku.id}">${buku.judul}</option>
            `
            });

            $('#select2').append(option);
            $('#modalForm').modal()


            $('#modalForm').modal()

        },
        editPeminjaman(row_index) {
            this.editStatus = true;
            this.data = this.datas[row_index];

            $('#select2').empty();


            let option = ``;
            this.data.lists_buku.map(list_buku => {
                return option += `
                    <option value="${list_buku.id}" ${list_buku.dipinjam ? `selected` : ``}>${list_buku.judul}</option>
                `
            });


            $('#select2').append(option);
            $('#modalForm').modal()
        },
        detailPeminjaman(row_index) {
            this.data = this.datas[row_index];
            this.anggota = this.data.anggota;
            this.bukus = this.data.buku;
            $('#detailPeminjamanModal').modal();
        },
        deleteData(e, id) {
            if (confirm('Delete data ?')) {
                $(e.target).parents('tr').remove();
                axios.post(`${this.actionUrl}/${id}`, {
                    _method: 'DELETE'
                }).then(res => {
                    var table = $('#datatable').DataTable();
                    table.ajax.reload();
                    alert('data berhasil dihapus');
                }).catch(e => {
                    alert('data gagal dihapus');
                });
            }
        },
        submitForm(e, id) {
            var table = $('#datatable').DataTable();
            let actionUrl = !this.editStatus ? `${this.actionUrl}` : `${this.actionUrl}/${id}`

            axios.post(actionUrl, new FormData($(e.target)[0]))
                .then(res => {
                    $('#modalForm').modal('hide');
                    table.ajax.reload();
                }).catch(function (e) {
                    console.log(e);
                });
        }
    }
})