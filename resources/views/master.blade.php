<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/style.css" />
<link rel="icon" href="/images/logo.jpg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scouts en Gidsen Vlaanderen Dashboard@yield('subtitle')</title>
    @yield('javascipt')
</head>

<body>
    <header>
        <img class="logo" src="/images/logo.jpg" alt="logo" width="50" height="50" />
        <nav>
            <ul class="nav__links">
                <li><a href="/start"> Start </a></li>
                <li><a href="/login"> Login </a></li>
                <li><a href="/googleLogOut"> Logout </a></li>
                <li><a href="/activiteiten"> Activiteiten </a></li>
                @if(Auth::check())
                @if(auth()->user()->isAdmin())
                <li><a href="/registrations"> Inschrijvingen </a></li>
                <li><a href="/admin"> Admin </a></li>
                @endif
                @endif
            </ul>
        </nav>
        <a class="cta" href="/contact"><button>Contact</button></a>
    </header>
    <div class="main-background">
        @yield('content')
    </div>
</body>

</html>