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
                    <h3>Kategori Aset</h3>
                </div>

                <div class="float-right">
                    <button onclick="add()" type='button' class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>

            <div class="card-body">
                 <table id="example1" class="table table-bordered table-hover table-response">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($kategori as $no => $kategori)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$kategori->kategori_nama}}</td>
                            <td>
                                <button onclick="update(
                                    '{{$kategori->kategori_id}}',
                                    '{{$kategori->kategori_nama}}'
                                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                                <a href="{{route('delete-kategori', encrypt($kategori->kategori_id))}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')"><i class="fa fa-trash"></i> Delete</a>
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
                <form action="{{route('kategori-add')}}" method="POST">
                    <!-- selipkan token untuk kirim data type post -->
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="hidden" id="kategori_id" name="kategori_id">
                        <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" required>
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


@if(session('pesan'))
<script>
    $('#pesan').show()
    setInterval(function() {
        $('#pesan').hide()
    }, 2000);
</script>
@endif

<script>
    function add() 
    {
        $('#kategoriAdd').modal();
    }

    function update(id, nama) 
    {
        // alert(nama)
        document.getElementById('kategori_id').value = id;
        document.getElementById('kategori_nama').value = nama;
        $('#kategoriAdd').modal()
    }
</script>
@endsection

