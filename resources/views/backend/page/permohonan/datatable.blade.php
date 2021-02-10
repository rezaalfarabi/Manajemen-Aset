
<table id="example1" class="table table-bordered table-striped table-response">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Tanggal</th>
            <th>Type Permohonan</th>
            <th>Deskripsi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($permohonan as $no => $permohonan)
        <tr>
            <td>{{$no+1}}</td>
            <td>{{$permohonan->nama}}</td>
            <td>{{$permohonan->tgl_permohonan}}</td>
            <td>{{$permohonan->permohonan}}</td>
            <td>{{$permohonan->deskripsi}}</td>
            <td>
                @if(session('level') == 2)
                    @if($permohonan->status == 0)
                        <button onclick="status('{{$permohonan->id_permohonan}}', 1)" class="fa fa-check-circle badge badge-danger">Waiting</button>
                    @else
                        <button onclick="status('{{$permohonan->id_permohonan}}', 0)" class="fa fa-check-circle badge badge-success">Approve</button>   
                    @endif
                @else
                    @if($permohonan->status == 0)
                        <button class="fa fa-check-circle badge badge-danger">Waiting</button>
                    @else
                        <button class="fa fa-check-circle badge badge-success">Approve</button>   
                    @endif
                @endif
            </td>
            @if(session('level') == 1)
            <td>
                <button onclick="update(
                    '{{$permohonan->id_permohonan}}',
                    '{{$permohonan->nama}}',
                    '{{$permohonan->tgl_permohonan}}',
                    '{{$permohonan->permohonan}}',
                    '{{ $permohonan->deskripsi }}'
                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                <button type="button" onclick="hapus('{{$permohonan->id_permohonan}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>