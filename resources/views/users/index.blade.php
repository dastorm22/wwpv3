@extends('layouts.layout')

@section('title','Users')

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15 m-r-5">
                            <a href="{{ action('UserController@create') }}">
                                <button type="button" class="btn btn-primary waves-effect waves-light">
                                    Create <span class="m-l-5"><i class="ion-person-add"></i></span>
                                </button>
                            </a>
                        </div>

                        <h4 class="page-title">Users</h4>
                        <p class="text-muted page-title-alt">
                            {{ count($users) }} Total
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-list">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>E-mail</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @each('users.partials.list-row', $users, 'user')

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End row -->

            </div>
        </div>
    </div>
@stop

@push('scripts')

<script>
    $(document).ready(function () {
       //
    });
</script>
@endpush