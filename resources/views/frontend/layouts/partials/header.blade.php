<div class="top-header">
    <div class="container">
    
      <!--<div class="float-right">
        
      </div>-->
      <div class="clearfix"></div>
    </div>
  </div>

  <div class="main-navbar">
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand mr-5" href="{{ route('index') }}">
        <img src="{{asset('images/images (1).jpeg')}}" class="logo-image">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('books.index') }}">Recent Books</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter Books By</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Filter By Top Borrowed</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Upload Books</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="{{ route('books.upload') }}">Upload Now</a>
              <a class="dropdown-item" href="rules.html">Upload Rules</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{ route('books.search') }}" method="get">
          <input class="form-control mr-sm-2 search-form" type="text" placeholder="Search" aria-label="Search" name="s" value="{{ isset($searched)? $searched: '' }}">
          <button class="btn btn-secondary my-2 my-sm-0 search-button" type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>

    </div>
    
      <div class="dropdown float-right">
        <a class="dropdown-toggle pointer top-header-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i> My Account
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          @if(Auth::check())
            <a class="dropdown-item" href="{{ route('users.profile', Auth::user()->username) }}">Profile</a>
            <a class="dropdown-item" href="{{ route('users.dashboard') }}">Dashboard</a>
            {{-- <a href="" class="dropdown-item"><span class="item">10</span> items in wishlist</a> --}}
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>

          @else
            <a class="dropdown-item" href="{{ route('login') }}">Sign In</a>
            <a class="dropdown-item" href="{{ route('register') }}">Sign Up</a>
          @endif

        </div>
      </div>

  </nav>
</div>