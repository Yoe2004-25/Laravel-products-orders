<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add action</title>
</head>
<body>
    <h1>Add New action</h1>

    <form action="{{ route('action.store') }}" method="POST">
        @csrf
        <label>action</label>
        <input type="enum" name="action_type"><br>

        <label>action</label>
        <input type="number" name="description"><br>

      
        

        <button type="submit">Save</button>
    </form>
</body>
</html>
