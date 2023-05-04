@extends('admin.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Crews</h4>    
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
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
                        @foreach($crews as $row)
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
                <hr>
                <a href="/crews" class="btn btn-md btn-secondary">View All</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
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