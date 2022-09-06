<div class="form-group">
<div class="col-lg-12">
    @if(isset($label))
        <label>{{$label}}</label>
    @endif

    {{ $slot }}
</div>
</div>