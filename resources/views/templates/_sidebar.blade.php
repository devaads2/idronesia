<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-category">Menu</li>
      <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
          <i class="mdi mdi-palette menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      @can('admin')
      <li class="nav-item {{ request()->is('/user') ? 'active' : '' }}">
        <a class="nav-link" href="/user">
          <i class="menu-icon mdi mdi-account-multiple"></i>
          <span class="menu-title">User</span>
        </a>
      </li>
      <li class="nav-item {{ request()->is('/project') ? 'active' : '' }}">
        <a class="nav-link" href="/project">
          <i class="menu-icon mdi mdi-arrow-expand"></i>
          <span class="menu-title">Projects</span>
        </a>
      </li>
      <li class="nav-item {{ request()->is('/inventory') ? 'active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="menu-icon mdi mdi-wrench"></i>
          <span class="menu-title">Inventory</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="/inventory/drone">Drone</a></li>
            <li class="nav-item"><a class="nav-link" href="/inventory/batteries">Batteries</a></li>
            <li class="nav-item"><a class="nav-link" href="/inventory/equipments">Equipments</a></li>
            <li class="nav-item"><a class="nav-link" href="/inventory/kits">Kits</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ request()->is('/report') ? 'active' : '' }}">
        <a class="nav-link" href="/report">
          <i class="mdi mdi-file menu-icon"></i>
          <span class="menu-title">Report</span>
        </a>
      </li>
      @endcan
      


     @can('pilot')
     <li class="nav-item">
      <a class="nav-link" href="/checklist">
        <i class="menu-icon mdi mdi-check-circle"></i>
        <span class="menu-title">Checklist Pilot</span>
      </a>
    </li>
     @endcan
      
    @can('manager')
    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="mdi mdi-file menu-icon"></i>
        <span class="menu-title">Report Manager</span>
      </a>
    </li>
    @endcan
   
     


    </ul>
  </nav>