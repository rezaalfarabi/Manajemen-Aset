@include('backend.component.datatable')
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
                <button type="button" onclick="hapus('{{$aset->id_aset}}')" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')"><i class="fa fa-trash"></i> Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>