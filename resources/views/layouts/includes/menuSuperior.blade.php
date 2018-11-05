<nav class="navbar navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="logo">
                <img src="{{asset('images/CAL_logo.png')}}" alt="Logo" width="45"
                     style="margin-right: 15px; margin-top: -5px">
                <b>{{config('app.name','CAL')}}</b>
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse">
                <i class="fa fa-bars" style="font-size: 18pt"></i>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <!-- Left Side of Navbar -->
            <ul class="nav navbar-nav">

            </ul>

            <!-- Right Side of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @guest
                    {{--<li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>
                            Login</a></li>
                    <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-edit"></span>
                            Register</a></li>--}}
                    <li>
                        <a id="lkLogin" style="cursor: pointer"><span class="glyphicon glyphicon-log-in"></span>
                            Login
                        </a>
                    </li>
                    <script type="text/javascript">
                        $('#lkLogin').on('click', function () {
                            $.dialog({
                                title: 'Inicio de Sesión',
                                content: 'url:/login-dialog',
                                theme: 'supervan',
                                icon: 'glyphicon glyphicon-log-in',
                                columnClass: 'large'
                            });
                        });
                    </script>
                    <li>
                        <a id="lkRegister"><span class="glyphicon glyphicon-edit"></span>
                            Register
                        </a>
                    </li>
                    <script type="text/javascript">
                        $('#lkRegister').on('click', function () {
                            $.dialog({
                                title: 'Registro',
                                content: 'url:/register-dialog',
                                theme: 'supervan',
                                icon: 'glyphicon glyphicon-edit',
                                columnClass: 'large'
                            });
                        });
                    </script>
                @else
                    <li>
                        <a href="/home"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{asset('adminLTE-2.4.3/dist/img/avatar5.png')}}" class="user-image"
                                 alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{asset('adminLTE-2.4.3/dist/img/avatar5.png')}}" class="img-circle"
                                     alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                       class="btn btn-default btn-flat">
                                        <span class="glyphicon glyphicon-log-out"></span>
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>