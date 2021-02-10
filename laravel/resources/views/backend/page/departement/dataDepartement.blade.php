
<table id="example1" class="table table-bordered table-striped table-response">
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
                               <button type="button" onclick="hapus('{{ $departement->departement_id }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>