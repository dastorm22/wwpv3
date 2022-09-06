<div class="card-box">
    @if(isset($corner))
        <span class="pull-right">
            {{ $corner }}
        </span>
    @endif

    @if(isset($title))
    <h4 class="header-title m-t-0"><b>{{ $title }}</b></h4>
    @endif
    {{ $slot }}
</div>