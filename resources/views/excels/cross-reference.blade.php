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
                <td>
                    {{ $row['sources'][$sourceColumn->id]['price'] ?? '' }}
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
