@push('styles')
<link rel="stylesheet" href="{{ asset('system/plugins/sweet-alert2/sweetalert2.min.css') }}"> <!-- Sweet Alert 2 -->
@endpush

@push('scripts')
<script src="{{ asset('system/plugins/sweet-alert2/sweetalert2.min.js') }}"></script> {{-- Sweet Alert --}}

<script>

    $(document).ready(function() {
        @if(Session::has('alert_success'))
            swal('Success!', '{{  Session::get('alert_success') }}', 'success');
        @endif

        @if(Session::has('alert_error'))
            swal('Error!', '{{  Session::get('alert_error') }}', 'error');
        @endif

        @if(Session::has('alert_info'))
            swal('Please, note that...', '{{  Session::get('alert_info') }}', 'info');
        @endif
    });

</script>
@endpush