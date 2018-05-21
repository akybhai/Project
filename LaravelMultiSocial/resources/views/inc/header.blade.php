
                                    {{--<link rel="stylesheet" href="sa/css/bootstrap.css">--}}
                                    {{--<link rel="stylesheet" src="{{asset('css/bootstrap.css')}}">--}}
                                    {{--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}

                                    {{--<!-- jQuery -->--}}
                                    {{--<script src="sa/jquery/jquery.js"></script>--}}
                                    {{--<!-- Bootstrap Core JavaScript -->--}}
                                    {{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
                                    {{--<script src="sa/js/bootstrap.min.js"></script>--}}

  <div class="nav1">
    <nav class="navbar navbar-inverse navbar-static-top" style="margin: 0px">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="sa/img/nui-logo.jpg" alt="Logo" height="40px">
          </a>
        </div>
        <div id="navbar3" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Home</a></li>
            <li><a href="/YourCart">Cart</a></li>
            <li><a href="/userrequest">My Requests</a></li>
            <li><a href="help.html">Help</a></li>
            <li>
              <form class="navbar-form navbar-right" >
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button on-click="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                      </span>
                  </div>
                </div>
              </form>
            </li>

            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i><span class="caret"></span></a>

              <ul class="dropdown-menu">
                @guest
                  <li><a href="{{ route('login') }}">Login</a></li>
                  {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                @else
                <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fa fa-user fa-lg"></i> {{ Auth::user()->name }}</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-lg"></i>
                    Logout
                  </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>


                  </li>
                @endguest
              </ul>
            </li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
      <!--/.container-fluid -->
    </nav>
  </div>
