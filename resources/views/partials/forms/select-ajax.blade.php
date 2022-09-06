@php( $dotName = brackets_to_dots($name))

<select name="{{ $name }}"
        id="{{ $name }}"
        class="form-control {{$class ?? ''}} {{ $errors->has($dotName) ? 'parsley-error' : '' }}"
        data-placeholder="{{ $placeholder ?? '' }}"
        {!! $attributes ?? '' !!}
        {{ isset($multiple) ? 'multiple' : '' }}
        {{ isset($required) ? 'required' : '' }}>

    @foreach ($selected as $option)
        <option value="{{ $option->id }}" selected>
            {{ $option->name }}
        </option>
    @endforeach
</select>

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">{{ $errors->first($dotName) }}</li>
    </ul>
@endif
