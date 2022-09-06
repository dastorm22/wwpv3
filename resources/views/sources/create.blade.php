@extends('layouts.layout')

@section('title', 'New Source')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}"> {{-- Select2 Multi Select --}}
@endpush

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <form action="{{ action('SourceController@store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                {{ csrf_field() }}

                <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group pull-right m-t-15 m-r-5">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Save <span class="m-l-5"><i class="fa fa-check"></i></span>
                                </button>
                            </div>

                            <h4 class="page-title">New Source</h4>
                            <p class="text-muted page-title-alt">Creates a new file import source.</p>
                        </div>
                    </div>

                    <div class="row">
                        @include('sources.partials.form')
                    </div>
                </form>
            </div>
        </div><!-- container -->
    </div><!-- content -->

@stop

@push('scripts')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script> {{-- Form Validation --}}
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script> {{-- Select 2 Multi Select --}}

<script>
    $(document).ready(function() {
        // Select2
        $(".select2").select2();

        // Form Validation (must go after select2)
        $('form').parsley();
    });

</script>
@endpush