<tr>
    <td>
        <a href="{{ action('UserController@edit', $user) }}"><b>{{ $user->name }}</b></a>
    </td>

    <td>
        {{ $user->email }}</a>
    </td>

    <td>
        {{ $user->created_at->format(DATE_FORMAT) }}</a>
    </td>

    <td>
        {{ $user->updated_at->diffForHumans() }}</a>
    </td>
</tr>