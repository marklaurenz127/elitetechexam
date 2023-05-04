@extends('admin.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Add Documents</h4>    
            </div>
            <div class="card-body">
                <form method="POST" class="frmCrew">
                    <div class="form-group">
                        <label for="">Select crew</label>
                        <select name="crewid" class="form-control">
                            @foreach($crews as $row)
                                <option value="{{ $row['crewid'] }}">{{ $row['firstname']." ".$row['lastname'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" name="code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Document number</label>
                        <input type="number" name="documentnumber" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Date Issued</label>
                        <input type="date" name="dateissued" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Date Expiry</label>
                        <input type="date" name="dateexpiry" class="form-control">
                    </div>
                    <input type="hidden" value="add" name="process">
                    <button type="submit" id="btnAdd" class="form-control btn btn-primary">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Documents</h4>    
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="displayCrew" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Document #</th>
                                <th>Date Added</th>
                                <th>Date updated</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>
                                    {{ $ctr++ }}
                                </td>
                                <td>{{ $row['code'] }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td>{{ $row['documentnumber'] }}</td>
                                <td>{{ date('M d Y - H:i', strtotime($row['created_at'])) }}</td>
                                <td>{{ date('M d Y - H:i', strtotime($row['updated_at'])) }}</td>
                                <td>
                                    <a href="/document/{{ $row['documentid'] }}" class="btn btn-xs btn-info">
                                        View
                                    </a>
                                    <button type="button" id="deleteRecord" data-id="{{ $row['documentid'] }}" class="btn btn-xs btn-danger">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Document #</th>
                                <th>Date Added</th>
                                <th>Date updated</th>
                                <th>Tools</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#displayCrew').DataTable({
            columns: [
                {
                    sortable: true,
                    searchable: true,
                },{
                    sortable: true,
                    searchable: true,
                }, {
                    sortable: true,
                    searchable: true,
                }, {
                    sortable: true,
                    searchable: true,
                }, {
                    sortable: true,
                    searchable: true,
                }, {
                    sortable: true,
                    searchable: true,
                } , {
                    sortable: true,
                    searchable: true,
                }           
            ]
        });

        $(document).on('submit','.frmCrew', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '/document/CUdocument',
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(){
                    $('#btnAdd').html('Processing, please wait...');
                },success: function (data) { 
                    if(data.status){
                        alert(data.msg)
                        location.reload();
                    }
                    else{
                        alert(data.msg)
                        $('#btnAdd').html('Add');
                    }
                },complete: function(){
                    $('#btnAdd').html('Add');
                }
            });
        });

        $(document).on('click','#deleteRecord', function(e){
            $.post('/document/removeDocument',{
                documentid: $(this).data('id')
            }, function(data){
                if(data.status){
                    alert(data.msg)
                    window.location.href = "/documents";
                }
                else{
                    alert(data.msg)
                }
            },'json');
        });

    });
</script>
@endsection