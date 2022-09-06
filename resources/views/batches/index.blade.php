@extends('layouts.layout')

@section('title','Batches')

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Imports of {{ $source->name }}</h4>
                        <p class="text-muted page-title-alt">
                            {{ count($batches) }} Total
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        @component('partials.components.card-box')
                            @if(count($batches))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-list">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Imported</th>
                                                    <th></th>
                                                    <th>Products</th>
                                                </tr>
                                                </thead>

                                                <tbody>

                                                @each('batches.partials.list-row', $batches, 'batch')

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