@php( $dotName = brackets_to_dots($name))

<select name="{{ $name }}"
        id="{{ $name }}"
        class="form-control select2 {{$class ?? ''}} {{ $errors->has($dotName) ? 'parsley-error' : '' }}"
        {{ isset($required) ? 'required' : '' }}>

    @if(isset($placeholder))
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $key => $option)
        <option value="{{ $key }}"
                {{ (isset($selected) && ( (int) $selected === $key)) ||
                    (old($dotName) === $key) ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">{{ $errors->first($dotName) }}</li>
    </ul>
@endif
