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
                <table id="example1" class="table table-bordered table-striped table-response">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
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
                            <td>
                                @if($pegawai->level == 1)
                                <strong>Superadmin</strong>
                                @elseif($pegawai->level == 2)
                                <strong>Teknisi</strong>
                                @else
                                <strong>User</strong>
                                @endif
                            </td>
                            <td>{{$pegawai->username}}</td>
                            <!-- edit data -->
                            <td>
                                <button type="button" onclick="edit(
                                    '{{$pegawai->id_pegawai}}',
                                    '{{$pegawai->nama}}',
                                    '{{$pegawai->email}}',
                                    '{{$pegawai->level}}',
                                    '{{$pegawai->username}}'
                                )" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</button>
                                <!-- hapus data -->
                                <a href="{{route('delete-pegawai', encrypt($pegawai->id_pegawai))}}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data ini ??')"><i class="fa fa-trash"></i> Delete</a>
                                <!-- <button type="button" onclick="hapus('{{$pegawai->id_pegawai}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button> -->
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
    <div class="modal-dialog modal-lg">

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
                    <div class="row">
                    <!-- kiri -->
                        <div class="col-md-6">
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
                                <label for="">Password</label>
                                <input type="password" name="password" id="password" class="form-control" >
                            </div>

                            
                        </div>
                        <!-- kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Level</label>
                                <select name="level" id="level" class="form-control">
                                    <option value="">--Level--</option>
                                    <option value="1">Superadmin</option>
                                    <option value="2">Teknisi</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Ulangi Password</label>
                                <input type="password" name="ulangi_password" id="ulangi_password" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div align="right">
                        <button type="submit" class="btn btn-outline-primary">Save</button>
                        <button type="submit" class="btn btn-outline-warning">Reset</button>
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- fungsi untuk show dan hide status pesan -->
@if(session('pesan'))
<script>
    $('#pesan').show()
    setInterval(function() {
        $('#pesan').hide()
    }, 4000);
</script>
@endif

<!-- Fungsi Untuk Menambah data Pegawai menggunakan jquery -->
<script>
    function add() {
        $('#pegawaiAdd').modal()
    }

    function edit(id, nama, email, level, username)
    {
        $('#id').val(id)
        $('#nama').val(nama)
        $('#email').val(email)
        $('#level').val(level)
        $('#username').val(username)
        $('#pegawaiAdd').modal()
    }
</script>

<!-- Fungsi untuk notifikasi menggunakan sweet alert menggunakan jquery -->
<!-- <script>
    $('.delete').click(function() {      
        var pegawai_id = $(this).attr('pegawai-id')
        // alert(pegawai_id)
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'ingin Menghapus data dengan id '+ pegawai_id + ' ??',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                console.log(result)
            if (result) {
                window.location = ("/delete-pegawai/'+ id_pegawai + '");
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
            
    })
})
</script> -->

<!-- <script>
   function hapus(id) {      
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'ingin Menghapus data dengan id '+ id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then(function(result){
                console.log(result)
            if (result) {
                window.location = "/delete-pegawai/"+ id;
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
            
    })
})
</script> -->
@endsection
 