@extends('backend.template')

@section('content')
    <div class="row py-2">
        <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="float-left">
                    <h3>Type Permohonan</h3>
                </div>

                <div class="float-right">
                    <button onclick="add()" type='button' class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>

            <div class="card-body" id="isiType"> </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
<div id="typeAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Type Permohonan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Permohonan</label>
                        <input type="hidden" id="id_type_permohonan" name="id_type_permohonan">
                        <input type="text" name="permohonan" id="permohonan" class="form-control" required>
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
        $('#isiType').load('/data-type-permohonan')
    })

    // fungsi untuk menambah data dengan pop up modal bootstrap
    function add() 
    {
        $('#typeAdd').modal();
    }

    // fungsi untuk mengubah data dengan menggunakan jquery
    function update(id, permohonan) 
    {
        // alert(nama)
        document.getElementById('id_type_permohonan').value = id;
        document.getElementById('permohonan').value = permohonan;
        $('#typeAdd').modal()
    } 

    // fungsi untuk menyimpan dan mengubah data ke index dengan menggunakan ajax dan jquery
    function save() 
    {
        var id_type_permohonan = $('#id_type_permohonan').val()
        var permohonan = $('#permohonan').val()

        $.ajax({
            url : '/type-permohonan-save',
            type : 'POST',
            data : {
                '_token' : '{{ csrf_token() }}',
                'id_type_permohonan' : id_type_permohonan,
                'permohonan' : permohonan,
            },
            dataType : "JSON",
            success : function(data) {
                $('#typeAdd').modal('hide')
                $('#isiType').load('/data-type-permohonan')
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
        $('#id_type_permohonan').val('')
        $('#permohonan').val('')
    } 

    // fungsi untuk menghapus data menggunakan sweet alert dan toast js
    function deleteConfirmation(id) {
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
                    url: "{{url('/type-permohonan-hapus')}}/" + id,
                    data: {'_token': '{{ csrf_token() }}'},
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data)
                        if (data.success === true) {
                            swal("Done!", data.message, "success");
                        } else {
                            swal("Error!", data.message, "error");
                        }
                        $('#isiType').load('/data-type-permohonan')
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

