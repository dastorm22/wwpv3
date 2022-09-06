@extends('layouts.layout')

@section('title','Sources')

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" >
                                Options <span class="m-l-5"><i class="fa fa-cog"></i></span>
                            </button>
                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                <li><a href="{{ action('AnalysisController@process') }}">Trigger Analysis</a></li>
                            </ul>
                        </div>

                        <div class="btn-group pull-right m-t-15 m-r-5">
                            <a href="{{ action('SourceController@create') }}">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Create <span class="m-l-5"><i class="fa fa-plus"></i></span>
                                </button>
                            </a>
                        </div>

                        <h4 class="page-title">Sources</h4>
                        <p class="text-muted page-title-alt">
                            {{ count($sources) }} Total
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        @component('partials.components.card-box')
                            @if(count($sources))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-list">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>URL</th>
                                                    <th>Enabled</th>
                                                    <th>Imports</th>
                                                </tr>
                                                </thead>

                                                <tbody>

                                                @each('sources.partials.list-row', $sources, 'source')

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <h3 class="text-muted">No Results</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endcomponent
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

    });
</script>
@endpush