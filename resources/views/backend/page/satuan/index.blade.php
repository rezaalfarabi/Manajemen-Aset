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
                    <h3>Satuan</h3>
                </div>

                <div class="float-right">
                    <button onclick="add()" type='button' class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-response">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($satuan as $no => $satuan)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$satuan->satuan_nama}}</td>
                            <td>
                                <button onclick="update(
                                    '{{$satuan->satuan_id}}',
                                    '{{$satuan->satuan_nama}}'
                                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                                <a href="{{route('delete-satuan', encrypt($satuan->satuan_id))}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
                <form action="{{route('satuan-add')}}" method="POST">
                    <!-- selipkan token untuk kirim data type post -->
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Satuan</label>
                        <input type="hidden" id="satuan_id" name="satuan_id">
                        <input type="text" name="satuan_nama" id="satuan_nama" class="form-control" required>
                    </div>
                   
                    <div align="right"></div>
                    <button type="submit" class="btn btn-outline-primary">Save</button>
                    <button type="submit" class="btn btn-outline-warning">Reset</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- fungsi untuk menampilkan dan hidden notifikasi -->
@if(session('pesan'))
<script>
    $('#pesan').show()
    setInterval(function() {
        $('#pesan').hide()
    }, 3000);
</script>
@endif

<!-- fungsi untuk menambah data dengan menggunakan jquery -->
<script>
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
</script>
@endsection

