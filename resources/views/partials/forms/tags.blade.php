@php( $dotName = brackets_to_dots($name))

<select name="{{ $name }}"
        id="{{ $name }}"
        class="{{$class ?? ''}} {{ $errors->has($dotName) ? 'parsley-error' : '' }}"
        {{ isset($required) ? 'required' : '' }}
        {!! $attributes ?? '' !!}
        multiple
        data-role="tagsinput">

    @foreach ($tags as $tag)
        <option value="{{ $tag }}">{{ $tag }}</option>
    @endforeach

    @if ($errors->has($dotName .'.*'))
        @foreach (old($dotName) as $tag)
            <option value="{{ $tag }}">{{ $tag }}</option>
        @endforeach
    @endif
</select>

@if ($errors->has($dotName . '.*'))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">
            {{ collect($errors->get($dotName . '.*'))->first()[0] }}
        </li>
    </ul>
@endif
