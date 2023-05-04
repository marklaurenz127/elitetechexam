@extends('admin.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Add Admin</h4>    
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <button type="button" id="btnAddAdmin" class="form-control btn btn-primary">
                    Add
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Admins</h4>    
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="displayCrew" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $ctr++ }}</td>
                                <td>{{ $row['username'] }}</td>
                                <td>{{ $row['password'] }}</td>
                                <td>
                                    <button id="removeAdmin" data-username="{{ $row['username'] }}" class="btn btn-md btn-danger">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
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

        $(document).on('click','#removeAdmin',function(){
            $.post('/admin/removeAdmin',{
                username: $(this).data('username')
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
        
        $('#btnAddAdmin').click(function(){
            $.post('/admin/addAdmin',{
                username: $('#username').val(),
                password: $('#password').val(),
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