
<table>
    <tr>
        <th>Description</th>
        <th>Updated_at</th>
        <th>created_at</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Upc</th>
        <th>category</th>
        <th>seller</th>

    </tr>

    @foreach($ofert as $oferts)
        <tr>
            <td>{{ $oferts->name}}</td>
            <td>{{ $oferts->updated_at}}</td>
            <td>{{ $oferts->created_at}}</td>
            <td>{{ $oferts->price}}</td>
            <td>{{ $oferts->stock}}</td>
            <td>{{ $oferts->upc}}</td>
            <td>{{ $oferts->brand}}</td>
            <td>{{ $oferts->category}}</td>
            
        </tr>
    @endforeach
</table>