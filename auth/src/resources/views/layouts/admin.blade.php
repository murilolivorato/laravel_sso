
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="http://localhost:8081/build/assets/app-w40geAFS.js" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bulma/bulma-rtl.css') }}" rel="stylesheet">

    <!-- font awsome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
</head>
<body>
<div id="app">
    <section id="nav-header">
        <div class="container">
            <div class="columns">
                <div id="logo"><h1><a href="#"  >ADMIN</a></h1></div>
                <div class="column">
                    <div class="columns">
                        <div class="column">
                            <div class="menu-top-area">
                                <ul class="menu-top">
                                    <li><a href="/admin/home">Home</a></li>
                                  {{--  <li><a href="/admin/alterar-senha">Change Password</a></li>--}}
                                </ul>
                            </div>
                        </div>

                    <div  id="config-menu-area">
                        <ul id="nav-top" :class="menuStyle" >
                            <li class='top last' ><a href='#nogo22' id='nav-top-my-account' class='top_link' v-on:click="toggleMenu()" ><div id="user-profile"><span class='down'><i class="fa fa-user" aria-hidden="true"></i>  </span></div></a>
                                <ul class='sub' id="sub-nav-top-my-account" >
                                    <div class="bgsubmenutop bloco-item"></div>
                                    <div class="bgsubmenu bloco-item">
                                        <div class="bloco-item submenuic">
                                            <div class="columns">
                                                <div class="column">
                                                    <ul class="menu-top-cart-list-actions-dt">
                                                        <li>Hello {{$user['name'] }}</li>
                                                        <li>
                                                            <a  href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                                Logout
                                                            </a>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bgsubmenubottom bloco-item"></div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="main-containt">
        @yield('content')
    </section>
    <section id="footer">
        <div class="container">
            <div class="columns">
                <div class="column has-text-centered">
                    <p>Admin Area</p>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
