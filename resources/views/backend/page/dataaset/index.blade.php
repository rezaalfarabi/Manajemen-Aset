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

            <div class="card-body" id="isi"></div>
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
                    <div class="row">
                    <!-- kiri -->
                      <div class="col-md-6">
                      <input type="hidden" name="id_aset" id="id_aset">

                        <div class="form-group">
                            <label for="">Nama Aset</label>
                            <input type="text" name="nama_aset" id="nama_aset" class="form-control @error('nama_aset') is-invalid @enderror" placeholder="Nama Aset"> 
                        </div>

                        <div class="form-group">
                            <label for="">Serial Number</label>
                            <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Serial Number"> 
                        </div>

                        <div class="form-group">
                            <label for="">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" placeholder="Qty"> 
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
                            <input type="date" name="tanggal_pembuatan" id="tanggal_pembuatan" class="form-control  "  placeholder="Pilih Tanggal"> 
                        </div>

                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach($kategori as $kategori)
                                <option value="{{$kategori->kategori_id}}">{{$kategori->kategori_nama}}</option>
                                @endforeach
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="">Satuan </label>
                            <select name="satuan_id" id="satuan_id" class="form-control @error('satuan_id') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach($satuan as $satuan)
                                <option value="{{$satuan->satuan_id}}">{{$satuan->satuan_nama}}</option>
                                @endforeach
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="">Department/Lokasi</label>
                            <select name="departement_id" id="departement_id" class="form-control @error('departement_id') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach($departement as $departement)
                                <option value="{{$departement->departement_id}}">{{$departement->departement_nama}}</option>
                                @endforeach
                            </select> 
                        </div>
                     </div>
                    </div>
                   
                    <div align="right">
                        <button type="button" onclick="save()" class="btn btn-outline-primary">Save</button>
                        <button type="reset" class="btn btn-outline-warning">Reset</button>
                    </div>
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
    $(document).ready(function(){
       $('#isi').load('/data-table');
    })

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

    function save()
    {
        var id_aset = $('#id_aset').val()
        var nama_aset = $('#nama_aset').val()
        var serial_number = $('#serial_number').val()
        var qty = $('#qty').val()
        var nama_pegawai = $('#nama_pegawai').val()
        var tanggal_pembuatan = $('#tanggal_pembuatan').val()
        var kategori_id = $('#kategori_id').val()
        var satuan_id = $('#satuan_id').val()
        var departement_id = $('#departement_id').val()

        $.ajax({
            url: '/data-aset-simpan',
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'id_aset': id_aset,
                'nama_aset': nama_aset,
                'serial_number': serial_number,
                'qty': qty,
                'nama_pegawai': nama_pegawai,
                'tanggal_pembuatan': tanggal_pembuatan,
                'kategori_id': kategori_id,
                'satuan_id': satuan_id,
                'departement_id': departement_id,
            },
            dataType: 'JSON',
            success: function(data)
            {
                if(data.status == 200)
                {
                    $('#asetAdd').modal('hide');
                    $('#isi').load('/data-table');
                    kosong()
                }
            }
        })
    }

    function hapus(id_aset)
    {
        $.ajax({
            url: '/data-aset-hapus',
            type: 'POST',
            data: {
                'id_aset':id_aset,
                '_token': '{{ csrf_token() }}'
                },
            dataType: 'JSON',
            success: function(data)
            {
                if(data.status == 200)
                {
                    $('#isi').load('/data-table');
                }else{

                }
            }
        })
    }

    function kosong()
    {
        $('#id_aset').val('')
        $('#nama_aset').val('')
        $('#serial_number').val('')
        $('#qty').val('')
        $('#nama_pegawai').val('')
        $('#tanggal_pembuatan').val('')
        $('#kategori_id').val('')
        $('#satuan_id').val('')
        $('#departement_id').val('')
    }
</script>

@endsection

