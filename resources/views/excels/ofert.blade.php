
<table>
    <tr>
        <th>UPC</th>
        <th>Name</th>
        <th>SKU</th>
        <th>Category</th>
        <th>Brand</th>
        <th>WWP</th>
        <th>Oferts</th>
    </tr>

    @foreach($rows as $row)
        <tr>
            <td>{{ $row['product']['upc'] ?? '' }}</td>
            <td>{{ $row['product']['name'] ?? '' }}</td>
            <td>{{ $row['product']['sku'] ?? '' }}</td>
            <td>{{ $row['product']['category'] ?? '' }}</td>
            <td>{{ $row['product']['brand'] ?? '' }}</td>
            <td>{{ $row['sources'][5]['price'] ?? '' }}</td>
            <td>{{ $row['oferts'] ?? '' }}</td>
        </tr>
    @endforeach
</table>
@push('scripts')
<script>
    $(document).ready(function () {
        OfertList.init();

    });
</script>
@endpush