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
                    <h3>Data Pegawai</h3>
                </div>
                <div class="float-right">
                    <button type="button" onclick="add()" class="btn btn-success btn-sm"> <i class="fa fa-plus"> </i> Add </button>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-response">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nik</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $no => $pegawai)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$pegawai->nama}}</td>
                            <td>{{$pegawai->email}}</td>
                            <td>{{$pegawai->nik}}</td>
                            <td>{{$pegawai->username}}</td>
                            <!-- edit data -->
                            <td>
                                <button type="button" onclick="edit(
                                    '{{$pegawai->id_pegawai}}',
                                    '{{$pegawai->nama}}',
                                    '{{$pegawai->email}}',
                                    '{{$pegawai->nik}}',
                                    '{{$pegawai->username}}'
                                )" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</button>
                                <!-- hapus data -->
                                <a href="{{route('delete-pegawai', encrypt($pegawai->id_pegawai))}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau di hapus ?')"><i class="fa fa-trash"></i> Delete</a>
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
<div id="pegawaiAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Pegawai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <form action="{{route('add-pegawai')}}" method="POST">
                    <!-- selipkan token untuk kirim data type post -->
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="hidden" id="id" name="id_pegawai">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">NIK</label>
                        <input type="number" name="nik" id="nik" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password</label>
                        <input type="password" name="ulangi_password" id="ulangi_password" class="form-control" >
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
    function add() {
        $('#pegawaiAdd').modal()
    }

    function edit(id, nama, email, nik, username)
    {
        $('#id').val(id)
        $('#nama').val(nama)
        $('#email').val(email)
        $('#nik').val(nik)
        $('#username').val(username)
        $('#pegawaiAdd').modal()
    }
</script>
@endsection