@extends('backend.template')

@section('content')
    <div class="row py-2">
        <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="float-left">
                    <h3>Kategori Aset</h3>
                </div>

                <div class="float-right">
                    <button onclick="add()" type='button' class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>

            <div class="card-body" id="isiKategori"> </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
<div id="kategoriAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Kategori Aset</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="hidden" id="kategori_id" name="kategori_id">
                        <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" required>
                    </div>
                   
                    <div align="right"></div>
                    <button type="button" onclick="save()" class="btn btn-outline-primary">Save</button>
                    <button type="button" onclick="kosong()" class="btn btn-outline-warning">Reset</button>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="kosong()" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- load javascript to index with ajax -->
<script>
    $(document).ready(function() {
        $('#isiKategori').load('/data-kategori')
    })

    // fungsi untuk menambah data dengan pop up modal bootstrap
    function add() 
    {
        $('#kategoriAdd').modal();
    }

    // fungsi untuk mengubah data dengan menggunakan jquery
    function update(id, nama) 
    {
        // alert(nama)
        document.getElementById('kategori_id').value = id;
        document.getElementById('kategori_nama').value = nama;
        $('#kategoriAdd').modal()
    } 

    // fungsi untuk menyimpan dan mengubah data ke index dengan menggunakan ajax dan jquery
    function save() 
    {
        var kategori_id = $('#kategori_id').val()
        var kategori_nama = $('#kategori_nama').val()

        $.ajax({
            url : '/kategori-simpan',
            type : 'POST',
            data : {
                '_token' : '{{ csrf_token() }}',
                'kategori_id' : kategori_id,
                'kategori_nama' : kategori_nama,
            },
            dataType : "JSON",
            success : function(data) {
                $('#kategoriAdd').modal('hide')
                $('#isiKategori').load('/data-kategori')
                toastr.success(data.message, data.title, {
                    delay: 5000,
                    fadeOut: 4000,
                });
                kosong()
            }
        })
    } 

    // fungsi untuk clear data
    function kosong() 
    {
        $('#kategori_id').val('')
        $('#kategori_nama').val('')
    } 

    // fungsi untuk menghapus data menggunakan sweet alert dan toast js
    function deleteConfirmation(kategori_id) {
        swal({
            title: "Hapus?",
            text: "Anda yakin ingin menghapus data ini?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batalkan!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('/hapus')}}/" + kategori_id,
                    data: {'_token': '{{ csrf_token() }}'},
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data)
                        if (data.success === true) {
                            swal("Done!", data.message, "success");
                        } else {
                            swal("Error!", data.message, "error");
                        }
                        $('#isiKategori').load('/data-kategori')
                        toastr.success(data.message, data.title, {
                            delay: 5000,
                            fadeOut: 4000,
                        }); 
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
</script>
@endsection

