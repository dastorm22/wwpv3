<tr>
    <td><a href="{{ action('SourceController@edit', $source) }}">
        <b>{{ $source->name }}  {{ $source->is_main ? '(Main)' : '' }}</b>
        </a>
    </td>
    <td>{{ $source->type_name }}</td>
    <td>{{ Str::limit($source->url, 100) }}</td>
    <td>{{ $source->is_enabled ? 'YES' : 'NO' }}</td>
    <td>
        <a href="{{ action('BatchController@sourceIndex', $source) }}">
            {{ $source->batches_count }}
        </a>
    </td>
</tr>