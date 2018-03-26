<header class="app-header navbar">
  <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="nav navbar-nav d-md-down-none">
    <li class="nav-item px-3">
      <a class="nav-link" href="/">Dashboard</a>
    </li> 
  </ul>
  <ul class="nav navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        @if (Auth::check())
          <img src="" class="img-avatar" alt="{{ Auth::user()->email }}">
        @else
          <img src="{{ asset('images/avatars/avatar.png') }}" class="img-avatar" alt="avatar">
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center">
          <strong>Account</strong>
        </div>

        <a class="dropdown-item" href="" 
          onclick="event.preventDefault(); 
          document.getElementById('logout-form').submit();">
          <i class="fa fa-lock"></i> Logout </a>
      </div>
    </li>
  </ul>
  
  <button class="navbar-toggler aside-menu-toggler" type="button">
    <span class="navbar-toggler-icon"></span>
  </button>


 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
 @csrf

</form>
</header>
