@extends('layouts.layout')

@section('title', 'Edit User')

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <form action="{{ action('UserController@update', $user) }}" method="POST" class="form-horizontal" role="form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group pull-right m-t-15">
                                <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Options <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                <ul class="dropdown-menu drop-menu-right" role="menu">
                                    <li><a id="delete-resource" data-id="{{ $user->id }}">Delete</a></li>
                                </ul>
                            </div>

                            <div class="btn-group pull-right m-t-15 m-r-5">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Save <span class="m-l-5"><i class="fa fa-check"></i></span>
                                </button>
                            </div>

                            <h4 class="page-title">Edit User {{ $user->name }}</h4>
                            <p class="page-title-alt">Updated {{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Start Account Info -->
                        <div class="col-sm-6">
                            @component('partials.components.card-box')
                                @slot('title', 'User Information')

                                <div class="row m-t-40">
                                    <div class="col-md-12">

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Name')
                                            @include('partials.forms.input',[
                                                'name' => 'name',
                                                'value' => $user->name,
                                                'required' => true,
                                            ])
                                        @endcomponent

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'E-mail')
                                            @include('partials.forms.input',[
                                                'name' => 'email',
                                                'value' => $user->email,
                                                'required' => true,
                                            ])
                                        @endcomponent

                                    </div>
                                </div>
                            @endcomponent
                        </div>
                        <!-- End Account Info -->

                        <!-- Start Account Info -->
                        <div class="col-sm-6">
                            @component('partials.components.card-box')
                                @slot('title', 'Change Password')

                                <div class="row m-t-40">
                                    <div class="col-md-12">

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Password')
                                            @include('partials.forms.input',[
                                                'name' => 'password',
                                                'type' => 'password',
                                            ])
                                        @endcomponent

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Repeat Password')
                                            @include('partials.forms.input',[
                                                'name' => 'password_confirmation',
                                                'type' => 'password',
                                            ])
                                        @endcomponent

                                    </div>
                                </div>
                            @endcomponent
                        </div>
                        <!-- End Account Info -->

                    </div>

                </form>
            </div>
        </div><!-- container -->
    </div><!-- content -->

@stop

@push('scripts')

<script>

    $(document).ready(function() {
        DeleteResource.init({
            resourceName: 'user',
            resourceRoute: 'users',
            redirectUrl: '{{ action('UserController@index') }}',
        });

        // Form Validation (must go after select2)
        $('form').parsley();
    });

</script>
@endpush