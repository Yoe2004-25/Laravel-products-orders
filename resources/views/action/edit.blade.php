<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <h1></h1>
  <form action="{{ route('action.update', $action->id) }}" method="POST" >
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $action->action_type }}"><br>

    <button type="submit">edit</button>
  </form>
</body>
</html>
