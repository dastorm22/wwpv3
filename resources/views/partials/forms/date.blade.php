@php( $dotName = brackets_to_dots($name))

<div class="input-group">
    <input name="{{ $name }}"
           id="{{ $name }}"
           value="{{ isset($value) ? $value->format(DATE_FORMAT) : '' }}"
           type="text"
           class="form-control date-picker {{ $class ?? '' }} {{ $errors->has($dotName) ? 'parsley-error' : '' }}"
           placeholder="mm/dd/yyyy" >
    <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
</div><!-- input-group -->

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">{{ $errors->first($dotName) }}</li>
    </ul>
@endif