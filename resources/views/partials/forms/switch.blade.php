<input name="{{ $name }}"
       id="{{ $id ?? $name }}"
       type="checkbox"
       value="1"
       {{ isset($checked) ? 'checked' : ''}}
       data-size="{{ $size ?? 'small' }}"
       data-plugin="switchery"
       data-color="{{ $onColor ?? '#81c868'}}"
       data-secondary-color="{{ $offColor ?? '#f05050'}}"
>
@if(isset($label))
    <span class="m-l-5">{{ $label ?? '' }}</span>
@endif