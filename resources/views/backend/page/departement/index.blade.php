@extends('backend.template')

@section('content')
    <div class="row py-2">
        <div class="col-md-12">

        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="float-left">
                    <h3>Department</h3>
                </div>

                <div class="float-right">
                    <button onclick="add()" type='button' class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>

            <div class="card-body" id="isiDepartement"></div>
        </div>
    </div>
    </div>

    <!-- Modal -->
<div id="departementAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Department</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Department</label>
                        <input type="hidden" id="departement_id" name="departement_id">
                        <input type="text" name="departement_nama" id="departement_nama" class="form-control" required>
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


<script>
    $(document).ready(function() {
        $('#isiDepartement').load('/data-departement')
    })

    // fungsi untuk menambah dengan menampilkan pop up windows bootstrap
    function add() 
    {
        $('#departementAdd').modal();
    }

    // fungsi untuk mengubah data dengan menggunakan vanilla javascript
    function update(id, nama) 
    {
        // alert(nama)
        document.getElementById('departement_id').value = id;
        document.getElementById('departement_nama').value = nama;
        $('#departementAdd').modal()
    } 

    // fungsi untuk menambah data dengan menggunakan ajax jquery
    function save() {
        var departement_id = $('#departement_id').val()
        var departement_nama = $('#departement_nama').val()

        $.ajax({
            url : '/departement-simpan',
            type : 'POST',
            data : {
                '_token' : '{{ csrf_token() }}',
                'departement_id' : departement_id,
                'departement_nama' : departement_nama,
            },
            dataType : 'JSON',
            success : function(data) {
                $('#departementAdd').modal('hide')
                $('#isiDepartement').load('/data-departement')
                toastr.success(data.message, data.title, {
                    delay: 5000,
                    fadeOut: 4000,
                });
                kosong();
            }
        })
    } 

    // fungsi untuk clear data
    function kosong() {
        $('#departement_id').val('')
        $('#departement_nama').val('')
    } 

    // fungsi untuk menghapus data menggunakan ajax dan jquery
    function hapus(departement_id) {
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
                    url : '/departement-hapus',
                    type : 'POST',
                    data : {
                        '_token' : '{{ csrf_token() }}',
                        'departement_id' : departement_id
                    },
                    dataType : 'JSON',
                    success : function(data) {
                        console.log(data)
                        toastr.success(data.message, data.title, {
                                    delay: 5000,
                                    fadeOut: 4000,
                                }); 
                        $('#isiDepartement').load('/data-departement')
                    }
                })

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
 
    // fungsi untuk menghapus data menggunakan ajax dan jquery dan notofikasi menggunakan sweet alert
    // function deleteConfirmation(departement_id) {
    //     swal({
    //         title: "Hapus?",
    //         text: "Anda yakin ingin menghapus data ini?",
    //         type: "warning",
    //         showCancelButton: !0,
    //         confirmButtonText: "Ya, Hapus!",
    //         cancelButtonText: "Tidak, Batalkan!",
    //         reverseButtons: !0
    //     }).then(function (e) {

    //         if (e.value === true) {
    //             // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    //             $.ajax({
    //                 type: 'POST',
    //                 url: "{{url('/hapus')}}/" + departement_id,
    //                 data: {'_token': '{{ csrf_token() }}'},
    //                 dataType: 'JSON',
    //                 success: function (data) {
    //                     console.log(data)
    //                     if (data.success === true) {
    //                         swal("Done!", data.message, "success");
    //                     } else {
    //                         swal("Error!", data.message, "error");
    //                     }
    //                     $('#isiDepartement').load('/data-departement')
    //                     toastr.success(data.message, data.title, {
    //                         delay: 5000,
    //                         fadeOut: 4000,
    //                     }); 
    //                 }
    //             });

    //         } else {
    //             e.dismiss;
    //         }

    //     }, function (dismiss) {
    //         return false;
    //     })
    // }

</script>
@endsection

