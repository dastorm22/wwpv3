@php( $dotName = brackets_to_dots($name))

<select name="{{ $name }}"
        id="{{ $name }}"
        class="form-control {{$class ?? ''}} {{ $errors->has($dotName) ? 'parsley-error' : '' }}"
        {{ isset($required) ? 'required' : '' }}
        {{ isset($multiple) ? 'multiple' : '' }}
        {!! $attributes ?? '' !!}>

    @if(isset($placeholder))
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $option)
        <option value="{{ $option->id }}"
                {{ (isset($selected) && ($selected === $option->id)) ||
                    (old($dotName) === $option->id) ? 'selected' : '' }}>
            {{ $option->name }}
        </option>
    @endforeach
</select>

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">{{ $errors->first($dotName) }}</li>
    </ul>
@endif
