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

            <form class="form-horizontal" role="form" action="{{ url('/password/reset') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                @include('partials.forms.input', ['name' => 'email', 'placeholder' => 'E-mail', 'type' => 'text', 'required' => true])

                @include('partials.forms.input', [
                    'name' => 'password',
                    'placeholder' => 'Password',
                    'type' => 'password',
                    'required' => true,
                    'attributes' => 'minlength="6"'])

                @include('partials.forms.input', [
                    'name' => 'password_confirmation',
                    'placeholder' => 'Repeat Password',
                    'type' => 'password', 'required' => true,
                    'attributes' => 'data-parsley-equalto="#password"'
                ])

                <div class="form-group text-center m-t-40">
                    <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light"
                            type="submit">Reset Password
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