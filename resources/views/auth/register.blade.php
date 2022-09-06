@extends('layouts.auth-layout')

@section('title', 'Register')

@section('content')
    <div class="card-box">

        <div class="logo">
            <img class="logo" src="{{ asset('images/logo.png') }}"/>
        </div>

        <div class="panel-heading">
            <h3 class="text-center">Create an Account</h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" action="{{ url('/register') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group ">
                    <div class="col-xs-12">
                        @include('partials.forms.input', [
                            'name' => 'name',
                            'placeholder' =>
                            'Name',
                            'required' => true,
                            'autofocus' => true
                        ])
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        @include('partials.forms.input', [
                            'name' => 'email',
                            'placeholder' => 'E-mail',
                            'type' => 'email',
                            'required' => true
                        ])
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        @include('partials.forms.input', [
                            'name' => 'password',
                            'placeholder' => 'Password',
                            'type' => 'password',
                            'required' => true,
                            'attributes' => 'minlength="6"'
                        ])
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        @include('partials.forms.input', [
                            'name' => 'password_confirmation',
                            'placeholder' => 'Repeat Password',
                            'type' => 'password', 'required' => true,
                            'attributes' => 'data-parsley-equalto="#password"'
                        ])
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light"
                                type="submit">Create Account
                        </button>
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
    $(document).ready(function () {
        $('form').parsley();
    });
</script>

@endpush