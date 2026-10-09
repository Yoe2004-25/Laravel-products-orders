<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>deal</title>
</head>
<body>
    <h1>All Deal </h1>

    <a href="{{ route('action.create') }}">+ action product</a>

    <table border="1" cellpadding="5">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        @foreach($actions as $action)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="{{ route('action.edit', $deal->id) }}">Edit</a> |
                <form action="{{ route('action.destroy', $deal->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
