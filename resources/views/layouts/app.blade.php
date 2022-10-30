<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

     <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/sass/category.scss', 'resources/sass/main.scss', 'resources/sass/post.scss', 'resources/js/app.js', 'resources/js/search.js', 'resources/js/activePage.js'])
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</head>
<body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav">
           <div class="container">
            <a class="navbar-brand" href="#">
                <img src="" width="30" height="30" alt="" />
            </a>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav nav-links">
                    <a class="nav-item nav-link" href="./index.html"
                        >Categoria 1</a
                    >
                    <a class="nav-item nav-link" href="#">Categoria 2</a>
                    <a class="nav-item nav-link" href="#">Categoria 3</a>
                    <a class="nav-item nav-link" href="#">Categoria 4</a>
                </div>
            </div>

            <div class="text-lg">
                <h3>DATA</h3>
            </div>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
           </div>
        </nav>



        <!-- HEADER -->
        <header class="container col-8">
            <!-- SEARCHBAR -->
            <div class="searchbar mt-5" id="searchbar">
                <form class="form-inline" id="search-form">
                    <div class="input-group">
                        <input
                            id="search-query"
                            class="form-control p-3 mr-sm-2"
                            type="search"
                            placeholder="Pesquisar..."
                            aria-label="Pesquisar"
                        />
                        <button
                            class="btn btn-outline-dark px-4 my-sm-0"
                            type="submit"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- BREADCRUMB -->
            <div aria-label="breadcrumb" class="my-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="text-decoration-none text-dark-link">
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Categoria 1
                    </li>
                </ol>
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
        <!-- Bootstrap JavaScript Bundle with Popper -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"
        ></script>
        <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
        @vite(['resources/js/post.js'])
</body>
</html>
