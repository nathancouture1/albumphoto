<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<title>Albums</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	</head>

	<body>
    <main>
        <div id="app"> 
            <nav>
                @auth
                    <div id="connecte">
                        <span>Bonjour {{Auth::user()->name}}</span>
                        <a href="{{route("logout")}}"onclick="document.getElementById('logout').submit(); return false;" class="logout">Logout</a>
                        <form id="logout" action="{{route("logout")}}" method="post">
                        </form>
                    </div>
                    @else
                    <div id="boutonslr">
                        <a href="{{route("login")}}" id="login">Login</a>
                        <a href="{{route("register")}}" id="register">Register</a>
                    </div>
                @endauth
            </nav>
            @yield("content")
        </div>
    <script src="{{ asset('js/script.js') }}"></script>
    </main>
	</body>
</html>