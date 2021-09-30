@extends('layouts.css')
@section('body')
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color:#b7e425;">
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">{{ __('View Website') }}</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
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
                        <li><a class="dropdown-item" href="{{ route('admin') }}">Dashboard</a></li>
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

        <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 py-4 border-end">
                <ul class="nav flex-column nav-pills me-3">
                    <li class="nav-item">
                        <a class="nav-link @if(url()->current()==route('admin')) active @endif" href="{{ route('admin') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(url()->current()==route('application.index')) active @endif" href="{{ route('application.index') }}">Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(url()->current()==route('bank.index')) active @endif" href="{{ route('bank.index') }}">Banks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(url()->current()==route('user.index')) active @endif" href="{{ route('user.index') }}">Users</a>
                    </li>
                </ul>
            </div>
            <div class="col  bg-white">
                <main class="py-4" style="min-height:500px;">
                    @if (session('alert-success'))
                        <div class="alert alert-success">
                            {{ session('alert-success') }}
                        </div>
                    @endif
                    @if (session('alert-danger'))
                        <div class="alert alert-danger">
                            {{ session('alert-danger') }}
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
        </div>

    </div>
@endsection
