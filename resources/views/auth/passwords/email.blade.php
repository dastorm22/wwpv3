@extends('layouts.auth-layout')

@section('title', 'Reset Password')

@section('content')
    <div class="card-box">

        <div class="logo">
            <img class="logo" src="{{  asset('images/logo.png') }}"/>
        </div>

        <div class="panel-heading">
            <h3 class="text-center">Reset Password</h3>
        </div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" action="{{ url('/password/email') }}" method="POST">
                {{ csrf_field() }}

                @include('partials.forms.input', ['name' => 'email', 'placeholder' => 'E-mail', 'type' => 'email', 'required' => true, 'autofocus' => true])

                <div class="form-group text-center m-t-40">
                    <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light"
                            type="submit">Send Password Reset Link
                    </button>
                </div>

            </form>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>Already have an account? <a href="{{ url('/login') }}" class="text-primary m-l-5"><b>Log In</b></a>
            </p>
        </div>
    </div>
@stop

@push('scripts')

{{-- Form Validation --}}
<script type="text/javascript" src="{{ asset('system/plugins/parsleyjs/parsley.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('form').parsley();
    });
</script>

@endpush

