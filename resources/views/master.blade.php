<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/style.css" />

<head>
    <meta charset="UTF-8">
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
            </ul>
        </nav>
        <a class="cta" href="/contact"><button>Contact</button></a>
    </header>
    @yield('content')
</body>

</html>