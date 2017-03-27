<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'Vehicle Rescuer') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">{{ trans('layout.login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ trans('layout.register') }}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img class="img-circle" alt="{{ asset(Auth::user()->avatar) }}" width="35" height="35" src={{ asset( Auth::user()->avatar) }} >
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @if(Gate::allows('is-admin'))
                                <li>
                                    <a href="{{ route('admin') }}">
                                        <i class="fa fa-bus" style="font-size:20px;color:#0a568c"></i>
                                        {{ trans('layout.administration') }}
                                    </a>
                                </li>
                            @elseif(Gate::allows('is-partner'))
                                <li>
                                    <a href="{{ action('Partner\GarageController@index') }}">
                                        <i class="fa fa-handshake-o" style="font-size:20px;color:#0a568c"></i>
                                        {{ trans('layout.partner') }}
                                    </a>
                                </li>
                            @endif

                            @if(Gate::allows('is-partner'))
                                <li>
                                    <a href="{{ action('Partner\GarageController@indexInactive') }}">
                                        <i class="fa fa-handshake-o" style="font-size:20px;color:#0a568c"></i>
                                        Inactive Garages
                                    </a>
                                </li>
                            @endif

                            @if(Gate::allows('is-partner'))
                                <li>
                                    <a href="{{ action('Partner\GarageController@create') }}">
                                        <i class="fa fa-handshake-o" style="font-size:20px;color:#0a568c"></i>
                                        Create garage
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ action('Home\HomeController@myWorld') }}">
                                    <i class="fa fa-globe" style="font-size:20px;color:#0a568c" aria-hidden="true"></i>
                                    {{ trans('layout.my_world') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('Home\UserController@index') }}">
                                    <i class="fa fa-user-circle-o" style="font-size:20px;color:#0a568c"></i>
                                    {{ trans('layout.profile') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" style="font-size:20px;color:#0a568c"></i>
                                    {{ trans('layout.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
