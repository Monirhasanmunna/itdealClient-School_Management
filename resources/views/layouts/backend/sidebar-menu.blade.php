<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      @can('dashboard')
      <h3>DASHBOARD</h3>
      @endcan
      <ul class="nav side-menu">

        @can('dashboard')
           <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>  
        @endcan
       

        @can('user_management')
        <h3>User Management</h3>
        <li class="{{Request::is('user_management/*') ? 'active' : ''}}"><a><i class="fa-solid fa-boxes-stacked"></i> User Management <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu" style="{{Request::is('user_management/*') ? 'display: block' : ''}}">

            {{-- @can('user_management.permissions')
            <li class="{{Request::is('user_management/permission/*') ? 'current-page' : ''}}"><a href="{{route('userManagement.permission.index')}}">Permissions</a></li>
            @endcan --}}

            @can('user_management.roles')
            <li class="{{Request::is('user_management/role/*') ? 'current-page' : ''}}"><a href="{{route('userManagement.role.index')}}">Roles</a></li>
            @endcan

            @can('user_management.users')
            <li class="{{Request::is('user_management/user/*') ? 'current-page' : ''}}"><a href="{{route('userManagement.user.index')}}">Users</a></li>
            @endcan
          </ul>
        </li>
        @endcan

        

      </ul>
    </div>
  </div>