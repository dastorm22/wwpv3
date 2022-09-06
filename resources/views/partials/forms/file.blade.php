@php( $dotName = brackets_to_dots($name))

<input
    name="{{ $name }}"
    type="file"
    class="filestyle"
    {{ isset($required) ? 'required' : '' }}
    data-buttonname="btn-white"
>

@if ($errors->has($dotName))
    <ul class="parsley-errors-list filled">
        <li class="parsley-required">
            {{ collect($errors->get($dotName))->first() }}
        </li>
    </ul>
@endif