@extends('backend.template')

@section('content')
    <div class="row py-2">
        <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="float-left">
                    <h3>Satuan</h3>
                </div>

                <div class="float-right">
                    <button onclick="add()" type='button' class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>

            <div class="card-body" id="isiSatuan"></div>
        </div>
    </div>
    </div>

    <!-- Modal -->
<div id="satuanAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Satuan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Satuan</label>
                        <input type="hidden" id="satuan_id" name="satuan_id">
                        <input type="text" name="satuan_nama" id="satuan_nama" class="form-control" required>
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
        $('#isiSatuan').load('/data-satuan')
    })

    // fungsi untuk membuat pop up modal bootstrap
    function add() 
    {
        $('#satuanAdd').modal();
    }

    // fungsi untuk update data dengan menggunakan jquery
    function update(id, nama) 
    {
        // alert(nama)
        document.getElementById('satuan_id').value = id;
        document.getElementById('satuan_nama').value = nama;
        $('#satuanAdd').modal()
    } 

    function save() 
    {
        var satuan_id = $('#satuan_id').val()
        var satuan_nama = $('#satuan_nama').val() 

        $.ajax({
            url : '/satuan-simpan',
            type : 'POST',
            data : {
                '_token' : '{{ csrf_token() }}',
                'satuan_id' : satuan_id,
                'satuan_nama' : satuan_nama
            },
            dataType : 'JSON',
            success : function(data) {
                console.log(data)
                    $('#satuanAdd').modal('hide')
                    $('#isiSatuan').load('/data-satuan')
                    kosong()
            }
        })
    } 

    function hapus(satuan_id) {
        $.ajax({
            url : '/satuan-hapus',
            type : 'POST',
            data : {
                '_token' : '{{ csrf_token() }}',
                'satuan_id' : satuan_id
            },
            dataType : 'JSON',
            success : function(data) {
                console.log(data)
                    $('#isiSatuan').load('/data-satuan')
            }
        })
    }

    function kosong() {
        $('#satuan_id').val('')
        $('#satuan_nama').val('')
    }
</script>
@endsection

