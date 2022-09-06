<div class="panel panel-border {{ $class ?? 'panel-custom' }}">
    <div class="panel-heading">
        @if(isset($corner))
            <span class="pull-right">
            {{ $corner }}
        </span>
        @endif

        @if(isset($title))
            <h3 class="panel-title">{{ $title }}</h3>
        @endif
    </div>

    <div class="panel-body">
        {{ $slot }}
    </div>
</div>