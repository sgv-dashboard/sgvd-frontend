<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/styles.css" />
    <head>
        <meta charset="UTF-8">
        <title>Scouts en Gidsen Vlaanderen @yield('subtitle')</title>
        <script type="text/javascript" src="functies.js"></script>
    </head>
    <body>
        <header>
            <img class="logo" src="/images/logo.jpg" alt="logo" width="50" height="50"/>
            <nav>
                <ul class="nav__links">
                    <li><a href="/start"> Start </a></li>
                    <li><a href="/login"> Login </a></li>
                    <li><a href="/activiteiten"> Activiteiten </a></li>
                    <li><a href="/over"> Over</a></li>
                </ul>
            </nav>
            <a class="cta" href="contact"><button>Contact</button></a>
        </header>
        @yield('content')
    </body>
</html>
