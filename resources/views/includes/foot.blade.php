<script src="{{ asset('dashb/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('dashb/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

<script src="{{ asset('vendor/datatable-js/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/datatable-js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('dashb/libs/js/main-js.js') }}"></script>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>