<nav class="main-header navbar navbar-expand navbar-gray">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li> 
  </ul> 
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="btn btn-lg" title="Sign Out" href="{{ route('admin.logout.post') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i>
        </a>
        <form id="logout-form" action="{{ route('admin.logout.post') }}" method="POST" style="display: none;">
           {{ csrf_field() }}
        </form>
    </li>
  </ul>
</nav>
