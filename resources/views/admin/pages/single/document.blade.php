@extends('admin.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Details</h4>    
            </div>
            <div class="card-body">
                <form method="POST" class="frmDocument">
                    <div class="form-group">
                        <label for="">Select crew</label>
                        <select name="crewid" id="crewid" class="form-control">
                            @foreach($crews as $row)
                                @if(!empty($crew) && $row['crewid'] == $crew->crewid)
                                    <option value="{{ $row['crewid'] }}" selected>{{ $row['firstname']." ".$row['lastname'] }}</option>
                                @else
                                    <option value="{{ $row['crewid'] }}">{{ $row['firstname']." ".$row['lastname'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" name="code" class="form-control" value="{{ $data->code }}">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Document number</label>
                        <input type="number" name="documentnumber" class="form-control" value="{{ $data->documentnumber }}">
                    </div>
                    <div class="form-group">
                        <label for="">Date Issued</label>
                        <input type="date" name="dateissued" class="form-control" value="{{ $data->dateissued }}">
                    </div>
                    <div class="form-group">
                        <label for="">Date Expiry</label>
                        <input type="date" name="dateexpiry" class="form-control" value="{{ $data->dateexpiry }}">
                    </div>
                    <input type="hidden" value="update" name="process">
                    <input type="hidden" value="{{ $data->documentid }}" name="documentid">
                    <button type="submit" id="btnUpdate" class="form-control btn btn-primary">
                        Update
                    </button>
                </form>
                <hr>
                <button type="button" id="removeDocument" class="btn btn-md btn-danger form-control">
                    Remove
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header">
                <h4 class="card-title">Crew on this document</h4>    
            </div>
            <div class="card-body">
                @if(empty($crew))
                    <h3 class="text-center">None</h3>
                @else
                    <h3 class="text-center">{{ $crew->firstname." ".$crew->lastname }}</h3>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $(document).on('submit','.frmDocument', function(e){
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

        $('#removeDocument').click(function(){
            $.post('/document/removeDocument',{
                documentid: "{{ $data->documentid }}"
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