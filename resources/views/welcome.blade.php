<!DOCTYPE html>
<html>
<head>
    <title>Laravel Vue Task Manager</title>
    <link href="{{ asset('css/sass.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav>
        <ul>
            @auth
                <li><a href="{{ url('#/') }}">Task List</a></li>
                <li><a href="{{ url('#/add') }}">Add Task</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
            @endauth
        </ul>
    </nav>

    <router-view></router-view>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>