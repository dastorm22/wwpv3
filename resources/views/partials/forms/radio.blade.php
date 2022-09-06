@php( $dotName = brackets_to_dots($name))

@foreach ($options as $option)
<div class="radio {{$class ?? ''}} {{ $errors->has($dotName) ? 'parsley-error' : '' }}">
    <input type="radio"
           name="{{ $name }}"
           id="{{ $name . '-' . $loop->iteration }}"
           value="{{ $option->id }}"

           {{ (isset($selected) && ($selected === $option->id)) ||
                (old($dotName) === $option->id) ? 'checked' : '' }}

           {{ isset($required) ? 'required' : '' }}

           {{ (isset($disabled) && (in_array($option->id, $disabled))) ? 'disabled' : '' }}>

    <label for="{{ $name . '-' . $loop->iteration }}">
        <b>{{ $option->name }}</b>

        @if(isset($option->description))
            ({{$option->description}})
        @endif
    </label>
</div>
@endforeach

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">{{ $errors->first($dotName) }}</li>
    </ul>
@endif
