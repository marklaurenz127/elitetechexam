@extends('admin.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Details</h4>    
            </div>
            <div class="card-body">
                <form method="POST" class="frmCrew">
                    <div class="form-group">
                        <label for="">First name</label>
                        <input type="text" name="firstname" class="form-control" value="{{ $data->firstname }}">
                    </div>
                    <div class="form-group">
                        <label for="">Middle name</label>
                        <input type="text" name="middlename" class="form-control" value="{{ $data->middlename }}">
                    </div>
                    <div class="form-group">
                        <label for="">Last name</label>
                        <input type="text" name="lastname" class="form-control" value="{{ $data->lastname }}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $data->email }}">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $data->address }}">
                    </div>
                    <div class="form-group">
                        <label for="">Education</label>
                        <input type="text" name="education" class="form-control" value="{{ $data->education }}">
                    </div>
                    <div class="form-group">
                        <label for="">Contact number</label>
                        <input type="text" name="contactnumber" class="form-control" value="{{ $data->contactnumber }}">
                    </div>
                    <input type="hidden" name="crewid" value="{{ $data->crewid }}">
                    <input type="hidden" value="update" name="process">
                    <button type="submit" id="btnUpdate" class="form-control btn btn-primary">
                        Update
                    </button>
                </form>
                <hr>
                <button type="button" id="removeRecord" class="btn btn-md btn-danger form-control">
                    Remove
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Documents</h4>    
            </div>
            <div class="card-body">
                @if(count($documents) > 0)
                <ol>
                    @foreach($documents as $row)
                        <li>
                            {{ $row['name'] }}
                        </li>
                    @endforeach
                </ol>
                @else
                <h2 class="text-center">
                    None
                </h2>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $(document).on('submit','.frmCrew', function(e){
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
                    $('#btnUpdate').html('Processing, please wait...');
                },success: function (data) { 
                    if(data.status){
                        alert(data.msg)
                        location.reload();
                    }
                    else{
                        alert(data.msg)
                        $('#btnUpdate').html('Update');
                    }
                },complete: function(){
                    $('#btnUpdate').html('Update');
                }
            });
        });

        $('#removeRecord').click(function(){
            $.post('/crew/removeCrew',{
                crewid: "{{ $data->crewid }}"
            }, function(data){
                if(data.status){
                    alert(data.msg)
                    window.location.href = "/";
                }
                else{
                    alert(data.msg)
                }
            },'json');
        });
    });
</script>
@endsection