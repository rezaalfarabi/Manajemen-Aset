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
                    <h3>Data Aset</h3>
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
                            <th>Nama Aset</th>
                            <th>Serial Number</th>
                            <th>Kategori</th>
                            <th>Tanggal/Tahun pembuatan</th>
                            <th>Qty</th>
                            <th>Satuan </th>
                            <th>Nama Pegawai</th>
                            <th>Department/Lokasi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($aset as $no => $aset)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$aset->nama_aset}}</td>
                            <td>{{$aset->serial_number}}</td>
                            <td>{{$aset->kategori_nama}}</td>
                            <td>{{$aset->tanggal_pembuatan}}</td>
                            <td>{{$aset->qty}}</td>
                            <td>{{$aset->satuan_nama}}</td>
                            <td>{{$aset->nama_pegawai}}</td>
                            <td>{{$aset->departement_nama}}</td>
                            <td>
                                @if($aset->status == 0)
                                    <a href="{{ route('data-aset-status', [ $aset->id_aset, 1]) }}" class="fa fa-times-circle badge badge-danger"> Belum Tersedia</a>
                                    @else
                                    <a href="{{route('data-aset-status', [$aset->id_aset, 0])}}" class="fa fa-check-circle badge badge-success"> Tersedia</a>
                                @endif
                            </td>
                            
                            <td>
                                <button onclick="update(
                                    '{{$aset->id_aset}}',
                                    '{{$aset->nama_aset}}',
                                    '{{$aset->serial_number}}',
                                    '{{$aset->kategori_id}}',
                                    '{{$aset->tanggal_pembuatan}}',
                                    '{{$aset->qty}}',
                                    '{{$aset->satuan_id}}',
                                    '{{$aset->nama_pegawai}}',
                                    '{{$aset->departement_id}}',
                                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                                <a href="{{route('data-aset-hapus', $aset->id_aset)}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')"><i class="fa fa-trash"></i> Delete</a>
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
<div id="asetAdd" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Aset</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <form action="{{route('data-aset-simpan')}}" method="POST">
                    <!-- selipkan token untuk kirim data type post -->
                    @csrf
                    <div class="row">
                    <!-- kiri -->
                      <div class="col-md-6">
                      <input type="hidden" name="id_aset" id="id_aset">

                        <div class="form-group">
                            <label for="">Nama Aset</label>
                            <input type="text" name="nama_aset" id="nama_aset" class="form-control" placeholder="Nama Aset"> 
                        </div>

                        <div class="form-group">
                            <label for="">Serial Number</label>
                            <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Serial Number"> 
                        </div>

                        <div class="form-group">
                            <label for="">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control" placeholder="Qty"> 
                        </div>

                        <div class="form-group">
                            <label for="">Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Nama Pegawai"> 
                        </div>
                      </div>
                    <!-- kanan -->
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal/Tahun Pembuatan</label>
                            <input type="date" name="tanggal_pembuatan" id="tanggal_pembuatan" class="form-control"  placeholder="Pilih Tanggal"> 
                        </div>

                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($kategori as $kategori)
                                <option value="{{$kategori->kategori_id}}">{{$kategori->kategori_nama}}</option>
                                @endforeach
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="">Satuan </label>
                            <select name="satuan_id" id="satuan_id" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($satuan as $satuan)
                                <option value="{{$satuan->satuan_id}}">{{$satuan->satuan_nama}}</option>
                                @endforeach
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="">Department/Lokasi</label>
                            <select name="departement_id" id="departement_id" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($departement as $departement)
                                <option value="{{$departement->departement_id}}">{{$departement->departement_nama}}</option>
                                @endforeach
                            </select> 
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
    function add() 
    {
        $('#asetAdd').modal();
    }

// fungsi untuk mengubah data dengan menggunakan vanilla javascript
    function update(id, nama_aset, serial_number, kategori, tanggal_pembuatan, qty, satuan, nama_pegawai, departement) 
    {
        // alert(nama)
        document.getElementById('id_aset').value = id;
        document.getElementById('nama_aset').value = nama_aset;
        document.getElementById('serial_number').value = serial_number;
        document.getElementById('kategori_id').value = kategori;
        document.getElementById('tanggal_pembuatan').value = tanggal_pembuatan;
        document.getElementById('qty').value = qty;
        document.getElementById('satuan_id').value = satuan;
        document.getElementById('nama_pegawai').value = nama_pegawai;
        document.getElementById('departement_id').value = departement;
        $('#asetAdd').modal();
    }
</script>

@endsection

