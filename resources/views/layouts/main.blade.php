<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Laramovies</title>
    <!-- STYLES -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/global.css">
</head>
<body class="bg-secondary">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
            <div class="container">
                <a id="header-logo" class="navbar-brand" href="/">
                    LaraMovies
                </a>

                <button class="navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#menu-items">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="menu-items">
                    <ul class="navbar-nav">
                        @auth
                        <li class="nav-item">
                            <a href="/movies/create" class="nav-link">CRIAR FILME</a>
                        </li>

                        <li class="nav-item">
                            <a href="/movies" class="nav-link">MEUS FILMES</a>
                        </li>
                        @endauth
                    </ul>

                    <form class="d-flex d-lg-none" method="GET" action="/">
                        <input class="form-control" type="text" placeholder="Search" name="search">
                        <button type="submit" class="btn btn-outline-primary ms-2">Pesquisar</button>
                    </form>

                    @auth
                    <div class="d-lg-none mt-2">
                        <form action="/logout" method="post" class="m-0 p-0">
                            @csrf
                            <button class="btn btn-primary" type="submit">SAIR</button>
                        </form>
                    </div>
                    @endauth
                </div>

                <form class="d-none d-lg-flex" method="GET" action="/">
                    <input class="form-control" type="text" placeholder="Search" name="search">
                    <button type="submit" class="btn btn-outline-primary ms-2">Pesquisar</button>
                </form>

                <div class="text-end d-none d-lg-flex">
                    @guest
                    <a href="/login" class="btn btn-light ms-4 me-2">Login</a>
                    <a href="/register" class="btn btn-warning">Cadastre-se</a>
                    @endguest
                    
                    @auth
                    <form action="/logout" method="post" class="m-0 p-0">
                        @csrf
                        <button class="btn btn-primary ms-3" type="submit">SAIR</button>
                    </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="text-light">
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
    
            <div class="toast fade-in-up {{ session('error') || session('success') ? 'show' : '' }}" data-animation="true" data-autohide="true" data-delay="5000" style="position: absolute; bottom: 25px; left: 25px;">
                <div class="toast-body btn-{{ session('error') ? 'danger' : (session('success') ? 'success' : '') }}">
                    <span class="bi bi-x-circle-fill"></span>
                    <small class="mx-2">{{ session('error') ?? session('success') }}</small>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center text-lg-start bg-dark position-absolute col-12">
        <div class="text-muted text-center p-4">
            © 2021 - <a class="text-reset fw-bold" href="#">LaraMovies</a>
        </div>
    </footer>

    <!-- SCRIPTS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- SCRIPTS APP -->
    <script src="/js/global.js"></script>
</body>
</html>