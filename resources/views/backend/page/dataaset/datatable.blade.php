
<table id="example1" class="table table-bordered table-striped table-response">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Aset</th>
            <th>Serial Number</th>
            <th>Kategori</th>
            <th>Tahun Pengadaan</th>
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
            <td>{{$aset->tahun_pengadaan}}</td>
            <td>{{$aset->qty}}</td>
            <td>{{$aset->satuan_nama}}</td>
            <td>{{$aset->nama_pegawai}}</td>
            <td>{{$aset->departement_nama}}</td>
            <td>
                @if($aset->status == 0)
                <button onclick="status('{{ $aset->id_aset }}', 1)" class="fa fa-check-circle badge badge-danger"> Not Ready</button>
                    @else
                <button onclick="status('{{ $aset->id_aset }}', 0)" class="fa fa-check-circle badge badge-success"> Ready</button>   
                @endif
            </td>
            
            <td>
                <button onclick="update(
                    '{{$aset->id_aset}}',
                    '{{$aset->nama_aset}}',
                    '{{$aset->serial_number}}',
                    '{{$aset->kategori_id}}',
                    '{{$aset->tahun_pengadaan}}',
                    '{{$aset->qty}}',
                    '{{$aset->satuan_id}}',
                    '{{$aset->nama_pegawai}}',
                    '{{$aset->departement_id}}',
                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                <button type="button" onclick="hapus('{{$aset->id_aset}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>