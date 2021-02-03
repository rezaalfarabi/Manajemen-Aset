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
                    <h3>Department</h3>
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
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($departement as $no => $departement)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$departement->departement_nama}}</td>
                            <td>
                                <button onclick="update(
                                    '{{$departement->departement_id}}',
                                    '{{$departement->departement_nama}}'
                                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                                <a href="{{route('delete-departement', encrypt($departement->departement_id))}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')"><i class="fa fa-trash"></i> Delete</a>
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
                <form action="{{route('departement-add')}}" method="POST">
                    <!-- selipkan token untuk kirim data type post -->
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Department</label>
                        <input type="hidden" id="departement_id" name="departement_id">
                        <input type="text" name="departement_nama" id="departement_nama" class="form-control" required>
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


<!-- fungsi untuk menampilkan/hidde status dan set interval dengan menggunakan bootstrap alert -->
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
</script>
@endsection

