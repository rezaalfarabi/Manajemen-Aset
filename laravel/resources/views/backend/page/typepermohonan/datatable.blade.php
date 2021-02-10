
<table id="example1"  class="table table-bordered table-striped table-response">
    <thead>
        <tr>
            <th>No</th>
            <th>Permohonan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($type_permohonan as $no => $permohonan)
        <tr>
            <td>{{$no+1}}</td>
            <td>{{$permohonan->permohonan}}</td>
            <td>
                <button onclick="update(
                    '{{$permohonan->id_type_permohonan}}',
                    '{{$permohonan->permohonan}}'
                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                
                <button type="button" onclick="deleteConfirmation('{{ $permohonan->id_type_permohonan }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>