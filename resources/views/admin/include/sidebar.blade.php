<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link logo-switch text-center">
  DASHBOARD 
  </a>
  <div class="sidebar">
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a> 
          </li> 
        </ul>
      </nav>
    </div>
      @php
       $menuTypes=App\Helper\MyFuncs::userHasMinu();
      @endphp
      @foreach ($menuTypes as $menuType)
      @php
      $subMenus = App\Helper\MyFuncs::mainMenu($menuType->id);
      @endphp
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="{{ $menuType->icon }}"></i>
              <p>
                {{ $menuType->name }}
                <i class="fas fa-angle-left right"></i> 
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach ($subMenus as $subMenu)
              <li class="nav-item">
                <a href="{{ route(''.$subMenu->link) }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ $subMenu->name }}</p>
                </a>
              </li>
              @endforeach 
            </ul>
          </li>
        @endforeach 
        </ul>
      </nav>
  </div>
</aside>


      
