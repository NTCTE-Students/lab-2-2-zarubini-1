<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $task ?-> title ?? 'New task' }}</title>
</head>
<body>
    <h1>{{ $task ?-> title ?? 'New task' }}</h1>
    <p>Welcome to the task manager application!</p>
    <form action="{{ route('tasks.index', ['task' => $task]) }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $task ?-> title }}" required>
        <br><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ $task ?-> description }}</textarea>
        <br><br>
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="pending" {{ $task && $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ $task && $task->status == 'pending' ? 'selected' : '' }}>In progress</option>
            <option value="completed" {{ $task && $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
        <br><br>
        <button type="submit">{{ $task ? 'Update' : 'Create' }} task</button>
        <br><br>
        <a href="{{ route('index') }}">Back to tasks</a>
</body>
</html>
