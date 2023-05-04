@extends('admin.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Add Crew</h4>    
            </div>
            <div class="card-body">
                <form method="POST" class="frmAddCrew">
                    <div class="form-group">
                        <label for="">First name</label>
                        <input type="text" class="form-control" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="">Last name</label>
                        <input type="text" class="form-control" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="">Middle name</label>
                        <input type="text" class="form-control" name="middlename">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label for="">Education</label>
                        <input type="text" class="form-control" name="education">
                    </div>
                    <div class="form-group">
                        <label for="">Contact number</label>
                        <input type="text" class="form-control" name="contactnumber">
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
                <h4 class="card-title">Crews</h4>    
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="displayCrew" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First name</th>
                                <th>last name</th>
                                <th>Middle name</th>
                                <th>Email</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>
                                    {{ $ctr++ }}
                                </td>
                                <td>{{ $row['firstname'] }}</td>
                                <td>{{ $row['lastname'] }}</td>
                                <td>{{ $row['middlename'] }}</td>
                                <td>{{ $row['email'] }}</td>
                                <td>
                                    <a href="/crew/{{ $row['crewid'] }}" class="btn btn-xs btn-info">
                                        View
                                    </a>
                                    <button type="button" id="deleteRecord" data-id="{{ $row['crewid'] }}" class="btn btn-xs btn-danger">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>First name</th>
                                <th>last name</th>
                                <th>Middle name</th>
                                <th>Email</th>
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
                }            
            ]
        });

        $(document).on('submit','.frmAddCrew', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '/crew/CUcrew',
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
            e.preventDefault()
            $.post('/crew/removeCrew',{
                crewid: $(this).data('id')
            }, function(data){
                if(data.status){
                    alert(data.msg)
                    location.reload();
                }
                else{
                    alert(data.msg)
                }
            },'json');
        });
    });
</script>
@endsection