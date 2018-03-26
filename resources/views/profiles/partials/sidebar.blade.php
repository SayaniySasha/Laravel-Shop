<!-- Sidebar -->
<div id="sidebar-wrapper">
  <ul class="sidebar-nav">
    <li class="sidebar-brand">
      <a href="#">
      Hello {{ Auth::user()->name}}!
      </a>
    </li>
    <li>
      <a href="/home">My Dashboard</a>
    </li>
    <li>
      <a href="{{url('profile', ['username' => Auth::user()->name])}}"> My Profile</a>
    </li>
    <li>
      <a href="#">Overview</a>
    </li>
  </ul>
</div>
<!-- /#sidebar-wrapper -->
