<tr>
    <td>{{ $batch->id }}</td>
    <td>{{ $batch->created_at->format(DATETIME_FORMAT) }}</td>
    <td>{{ $batch->created_at->diffForHumans() }}</td>
    <td>{{ $batch->products_count }}</td>
</tr>