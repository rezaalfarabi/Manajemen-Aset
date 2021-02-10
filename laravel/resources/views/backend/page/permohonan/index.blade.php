@extends('backend.template')
 
@section('content')
    <div class="row py-2">
        <div class="col-md-12">
        @if(session('pesan'))
            <div style="display:none" id="pesan" class="alert alert-success">
            {{session('pesan')}}
            </div>
        @endif
        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="float-left">
                    <h3>Permohonan</h3>
                </div>

                <div class="float-right">
                    <button onclick="add()" type='button' class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>

            <div class="card-body" id="isiPermohonan"></div>
        </div>
    </div>
    </div>

    <!-- Modal -->
<div id="permohonanAdd" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Permohonan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <input type="hidden" name="id_permohonan" id="id_permohonan">

                <div class="form-group">
                    <label for="">Jenis Permohonan</label>
                    <select name="type_permohonan" id="type_permohonan" class="form-control">
                        <option value="">-Select-</option>
                        @foreach($type_permohonan as $permohonan)
                        <option value="{{$permohonan->id_type_permohonan}}">{{$permohonan->permohonan}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Deskripsi Permohonan</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                </div>
                   
                <div align="right">
                    <button type="button" onclick="save()" class="btn btn-outline-primary">Save</button>
                    <button type="button" onclick="kosong()" class="btn btn-outline-warning">Reset</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="kosong()" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- fungsi untuk menampilkan dan hidden & setinterval dengan menggunakan bootstrap alert -->
@if(session('pesan'))
<script>
    $('#pesan').show()
    setInterval(function() {
        $('#pesan').hide()
    }, 4000);
</script>
@endif

<!-- fungsi untuk menambah data dengan menggunakan jquery -->
<script>
    $(document).ready(function(){
       $('#isiPermohonan').load('/data-permohonan');
    })

    function add() 
    {
        $('#permohonanAdd').modal();
    }

// fungsi untuk mengubah data dengan menggunakan vanilla javascript
    function update(id, type, deskripsi) 
    {
        // alert(nama)
        document.getElementById('id_permohonan').value = id;
        document.getElementById('type_permohonan').value = type;
        document.getElementById('deskripsi').value = deskripsi;
        $('#permohonanAdd').modal();
    }

    // fungsi untuk simpan data aset menggunakan jquery ajax
    function save()
    {
        var id_permohonan = $('#id_permohonan').val()
        var type_permohonan = $('#type_permohonan').val()
        var deskripsi = $('#deskripsi').val()

        $.ajax({
            url: '/permohonan-simpan',
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'id_permohonan': id_permohonan,
                'type_permohonan': type_permohonan,
                'deskripsi': deskripsi
            },
            dataType: 'JSON',
            success: function(data)
            {
                // console.log(data)
                $('#permohonanAdd').modal('hide');
                $('#isiPermohonan').load('/data-permohonan');
                    toastr.success(data.message, data.title, {
                    delay: 5000,
                    fadeOut: 4000,
                });
                kosong()
            }
        })
    }

    // fungsi untuk clear input
    function kosong()
    {
        $('#id_permohonan').val('')
        $('#type_permohonan').val('')
        $('#deskripsi').val('')
    }

// fungsi untuk melihat status menggunakan jquery ajax
    function status(id_permohonan, status) 
    {
        $.ajax({
            url: '/permohonan-status',
            type: 'post',
            data: {
                'id_permohonan' : id_permohonan,
                'status' : status,
                '_token' : '{{ csrf_token() }}'
            },
            dataType : 'json',
            success : function(data) 
            {
                $('#isiPermohonan').load('/data-permohonan');
                    toastr.success(data.message, data.title, {
                    delay: 5000,
                    fadeOut: 4000,
                });
            }
            
        })
    } 

    function hapus(id_permohonan) {
        $.ajax({
            url : '/permohonan-hapus',
            type : 'POST',
            data : {
                '_token' : '{{ csrf_token() }}',
                'id_permohonan' : id_permohonan
            },
            dataType : 'JSON',
            success : function(data) {
                console.log(data)
                toastr.success(data.message, data.title, {
                            delay: 5000,
                            fadeOut: 4000,
                        }); 
                $('#isiPermohonan').load('/data-permohonan')
            }
        })
    }
</script>
@endsection

