<div class="checkbox checkbox-circle {{ $class ?? 'checkbox-success' }}">
    <input name="{{ $name }}"
           id="{{ $id ?? $name }}"
           type="checkbox"
           value="1"
           {{ isset($checked) && $checked ? 'checked' : ''}}>
    <label for="{{ $id ?? $name }}">
        {{$label}}
    </label>
</div>