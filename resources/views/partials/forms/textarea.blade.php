@php( $dotName = brackets_to_dots($name))

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        class="form-control {{ $errors->has($dotName) ? 'parsley-error' : '' }}"
        {{ isset($required)  ? 'required' : '' }}
        {{ isset($autofocus) ? 'autofocus' : '' }}>{{ old($dotName) ?? $value ?? '' }}</textarea>

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">{{ $errors->first($dotName) }}</li>
    </ul>
@endif