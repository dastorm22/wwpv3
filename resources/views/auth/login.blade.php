@extends('layouts.auth-layout')

@section('title', 'Login')

@section('content')
    <div class="card-box">

        <div class="logo">
            <img class="logo" src="{{ asset('images/logo.png') }}"/>
        </div>

        <div class="panel-heading">
            <h3 class="text-center">Sign In</h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input name="email" id="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'parsley-error' : '' }}" type="email" placeholder="E-mail" required autofocus>
                        @if ($errors->has('email'))
                            <ul class="parsley-errors-list filled" id="parsley-id-5">
                                <li class="parsley-required">{{ $errors->first('email') }}</li>
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="password" id="password" type="password" class="form-control {{ $errors->has('email') ? 'parsley-error' : '' }}" required>
                    </div>
                    @if ($errors->has('password'))
                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                            <li class="parsley-required">{{ $errors->first('password') }}</li>
                        </ul>
                    @endif
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input name="remember" id="remember" type="checkbox">
                            <label for="remember">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light"
                                type="submit">Log In
                        </button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="{{ url('/password/reset') }}" class="text-dark">
                            <i class="fa fa-lock m-r-5"></i> Forgot your password?
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@stop

@push('scripts')

{{-- Form Validation --}}
<script type="text/javascript" src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

@endpush

