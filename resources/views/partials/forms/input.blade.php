@php( $dotName = brackets_to_dots($name))

    <input name="{{ $name }}"
           id="{{ $name }}"
           value="{{ old($dotName) ?? $value ?? '' }}"
           type="{{ $type ?? 'text' }}"
           placeholder="{{ $placeholder ?? '' }}"
           class="form-control {{ $class ?? '' }} {{ $errors->has($dotName) ? 'parsley-error' : '' }}"
           {{ isset($required) ? 'required' : '' }}
           {{ isset($autofocus) ? 'autofocus' : '' }}
           {!! $attributes ?? '' !!}
            >

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">{{ $errors->first($dotName) }}</li>
    </ul>
@endif