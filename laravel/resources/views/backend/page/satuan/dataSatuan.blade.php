
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
                <button type="button" onclick="hapus('{{ $satuan->satuan_id }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>