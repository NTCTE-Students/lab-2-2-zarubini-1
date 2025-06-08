<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task manager</title>
    <style>
        * {
            background: rgb(255, 231, 235)
        }
        .filer {
            display: flex;
            gap: 50px;
            border: 2px solid rgb(252, 252, 195);
            width: fit-content;
            padding: 5px;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <h1>Task manager</h1>
    <h2 style="color: palevioletred">Made by cool girls</h2>
    <p>Welcome to the task manager application!</p>
    @auth
        <p>Hello, {{ auth()->user()->name }}!</p>
        <ul>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    @else
        <p>To get started, please register or log in.</p>
        <ul>
            <li><a href="{{ route('register') }}">Register</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    @endauth
    @auth
    <h2>Tasks</h2>
    <div class="filer">
        <div>
            <p>Filter by:</p>
            <form>
                <label for="status_filter">Status</label>
                <select id="status_filter" name="status_filter">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In progress</option>
                    <option value="complete">Complete</option>
                </select>
                <br><br>
                <input type="submit" value="Filter">
            </form>
        </div>
        <div>
            <p>Order by:</p>
            <form>
                <label for="order_by">Date</label>
                <select id="order_by" name="order_by">
                    <option value="">All</option>
                    <option value="date_asc">New</option>
                    <option value="date_desc">Old</option>
                </select>
                <br><br>
                <input type="submit" value="Order">
            </form>
        </div>

    </div>

    <p>Find:</p>
    <form>
        <label for="find">Title</label>
        <input type="text" name="find" id="find" placeholder="input title">
        <br><br>
        <input type="submit" value="Search">
    </form>
    @endauth


    @auth
        @if ($user_tasks -> count() > 0)
            <ul>
                @foreach ($user_tasks -> get() as $task)
                    <li>
                        <h3>
                            <b>{{ $task->title }}</b>
                            -
                            {{ $task->status }}
                            |
                            <a href="{{ route('tasks.index', $task -> id) }}">View</a>
                            <a href="{{ route('tasks.delete', $task -> id) }}">Delete</a>
                        </h3>
                        <p>{{ $task->description }}</p>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('tasks.index') }}">Create a new task</a></p>
        @else
            <p>You have no tasks yet. <a href="{{ route('tasks.index') }}">Create a new task</a></p>
        @endif
    @else
        <p>You need to be logged in to see your tasks.</p>
    @endauth
</body>
</html>
