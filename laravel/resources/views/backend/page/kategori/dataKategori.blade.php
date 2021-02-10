
<table id="example1"  class="table table-bordered table-striped table-response">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($kategori as $no => $kategori)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$kategori->kategori_nama}}</td>
                            <td>
                                <button onclick="update(
                                    '{{$kategori->kategori_id}}',
                                    '{{$kategori->kategori_nama}}'
                                )" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>
                                
                                <button type="button" onclick="deleteConfirmation('{{ $kategori->kategori_id }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>