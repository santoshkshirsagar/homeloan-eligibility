<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                </ul>
                <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" href="#">{{ __('Login') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </li>
                @endguest
                </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col">

            <div class="flex-shrink-0 p-3" style="width:250px;">
                    <?php
                    $menu=array(
                        "Home" => array(
                            route('admin') => ["icon"=>"fas fa-tachometer-alt", "label"=>"Dashboard"],
                        ),
                        "Website" => array(
                            route('home') => ["icon"=>"fas fa-home", "label"=>"Home"],
                        ),
                    );
                    ?>
                    <ul class="list-unstyled ps-0">
                        @foreach($menu as $key=>$submenu)
                                <li class="mb-1">
                                <a class="btn btn-toggle align-items-center rounded @if(!array_key_exists(url()->current(), $submenu)) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#{{ $key }}-collapse" aria-expanded="@if(array_key_exists(url()->current(), $submenu)) true @else false @endif">
                                {{ $key }}
                                </a>
                                <div class="collapse @if(array_key_exists(url()->current(), $submenu)) show @endif" id="{{ $key }}-collapse">
                                <ul class="nav nav-pills flex-column">
                                    @foreach($submenu as $url=>$link)
                                    <li class="nav-item">
                                        <a class="nav-link @if(url()->current()==$url) bg-secondary text-white @endif" href="{{ $url }}"><i class="{{ $link['icon'] }} fa-fw"></i> 
                                        <span class="nav-text">{{ $link['label'] }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                </div>
                                </li>
                        @endforeach
                    </ul>
                </div>




            </div>
            <div class="col-md-9">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>
</html>
