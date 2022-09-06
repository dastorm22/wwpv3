@extends('layouts.layout')

@section('title','Comparison')

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12; text-center"><br><br><br>
                        <h1 class="text-center">Welcome To World Wide Perfumes</h1><br><br>
                        <img src="{{ asset('images/logo.png') }}" alt="Girl in a jacket" ><br><br><br>
                        <h3 class="text-center">Please select an option to the left sidebar</h3><br><br>
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
        OfertList.init();

    });
</script>
@endpush