<table>
    <tr>
        <th>UPC</th>
        <th>Name</th>
        <th>Stock</th>
        <th>Price</th>

        @foreach($sources as $source)
            @if($source->is_main)
                <th>{{ $source->name ?? '' }} Name</th>
                <th>{{ $source->name ?? '' }} Stock </th>

            @endif

            @if(!$isOnlyMain || $source->is_main)
                <th>{{ $source->name ?? '' }} Price </th>
            @endif
        @endforeach

        <th>Lowest</th>
        <th>Smart</th>
    </tr>

    @foreach($rows as $row)
        <tr>
            @php
                $min = $row['fileProduct']['price'];
                $mainPrice = 0;
            @endphp

            <td>{{ $row['fileProduct']['upc'] ?? '' }}</td>
            <td>{{ $row['fileProduct']['name'] ?? '' }}</td>
            <td>{{ $row['fileProduct']['stock'] ?? '' }}</td>
            <td>{{ $row['fileProduct']['price'] ?? '' }}</td>

            @foreach($sources as $source)
                @if($source->is_main)

                    <td>
                        {{ $row['product']['name'] ?? '' }}
                    </td>
                    <td>
                        {{ $row['sources'][$source->id]['stock'] ?? '' }}
                    </td>
                @endif

                @if(!$isOnlyMain || $source->is_main)
                    <td>
                        @php
                            $price = $row['sources'][$source->id]['price'] ?? null;

                            if($source->is_main) {
                                $mainPrice = $row['sources'][$source->id]['price'] ?? null;
                            } else if($price && $price < $min) {
                                $min = $price;
                            }
                        @endphp
                        {{ $price ?? '' }}
                    </td>
                @endif
            @endforeach

            <td>{{ $min ?? '' }}</td>
            <td>
                @php
                if($min && $mainPrice) {
                    if($min < 25) {
                        echo $min - 0.25;
                    } else if ($min < 50) {
                        echo $min - 0.50;
                    } else if($min < 75) {
                        echo $min - 0.75;
                    } else {
                        echo $min - 1;
                    }
                } else {
                    echo $min;
                }
                @endphp
            </td>
        </tr>
    @endforeach
</table>
