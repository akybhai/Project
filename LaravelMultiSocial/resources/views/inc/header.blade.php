<style media="screen">
  .nav1 .navbar-brand {
    height: 40px;
    padding: 5px;
    width: auto;
  }

  .nav1 .nav >li >a {
    padding-top: 15px;
    padding-bottom: 10px;
  }

</style>






<div class="nav1">
  <nav class="navbar navbar-inverse navbar-static-top" style="margin:0px">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}"><img src="sa/img/nui-logo.jpg" alt="Logo" height="40px">
        </a>
      </div>
      <div id="navbar3" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          {{--<li><a href="{{ url('/') }}">Home</a></li>--}}
          <li><a href="{{ url('/YourCart') }}">Cart</a></li>
          <li><a href="{{ url('/userrequest') }}">Requests</a></li>
          <li class="dropdown"><a class="app-nav__item dropdown-toggle" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i><span class="caret"></span></a>
            <ul class="dropdown-menu">
              @guest
                <li><a href="{{ route('login') }}">Login</a></li>
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



<!-- end of header -->
