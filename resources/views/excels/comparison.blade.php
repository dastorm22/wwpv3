
<table>
    <tr>
        <th>UPC</th>
        <th>Name</th>
        <th>SKU</th>
        <th>Category</th>
        <th>Brand</th>

        @foreach($sources as $source)
            <th>{{ $source->name ?? '' }}</th>
        @endforeach
    </tr>

    @foreach($rows as $row)
        <tr>
            <td>{{ $row['product']['upc'] ?? '' }}</td>
            <td>{{ $row['product']['name'] ?? '' }}</td>
            <td>{{ $row['product']['sku'] ?? '' }}</td>
            <td>{{ $row['product']['category'] ?? '' }}</td>
            <td>{{ $row['product']['brand'] ?? '' }}</td>

            @foreach($sources as $sourceColumn)
                @php
                    switch ($row['sources'][$sourceColumn->id]['class'] ?? null) {
                        case 'text-danger':
                            $style = "background-color: #ffc3c3;";
                            break;
                        case 'text-success':
                            $style = "background-color: #c9ffc1;";
                            break;
                        default:
                            unset($style);
                            break;
                    }
                @endphp
                <td style="{{$style ?? ''}}">
                    @isset($row['sources'][$sourceColumn->id]['price'])
                        {{ $row['sources'][$sourceColumn->id]['price'] ?? '' }}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
