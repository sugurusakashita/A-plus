<header class="nav" style="margin-top: 10px;">
  <div class="container">
    <div class="row-fluid">
      <div class="brand">
        <a href="/" class="">A+plus</a>
      </div>
      <div style="float: right;">
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Login</a></li>
            <li><a href="{{ url('/auth/register') }}">Register</a></li>
          @else
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu" style="position:static; height: 40px;">
                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
<!--       <nav class="right-float">
        <a href="#" class="btn btn-pill btn-primary-outline">Top</a>
        <a href="#" class="btn-pill">Search</a>
        <a href="#" class="btn-pill">Library</a>
      </nav>
 -->    
    </div>
  </div>
</header>
