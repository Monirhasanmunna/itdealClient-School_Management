<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      @can('dashboard')
      <h3>DASHBOARD</h3>
      @endcan
      <ul class="nav side-menu">

        @can('dashboard')
           <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>  
        @endcan


        @can('student')
        <li class="mt-2"><a><i class="fa fa-sitemap"></i> Student <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu" style="display: none;">

              <li><a href="#level1_1">Add Single Student</a>
              <li><a href="#level1_1">Add Multiple Student</a>

              </li><li class=""><a>Report<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none;">

                  <li class="sub_menu"><a href="level2.html">All Student</a></li>

                  <li><a href="#level2_1">Section Wise Summary</a></li>

                  <li><a href="#level2_2">Section Wise</a></li>

                </ul>
              </li>

              @can('student.setting')
              <li><a href="{{route('student.setting.session.index')}}">Setting</a>
              @endcan
              </li>
          </ul>
        </li>
        @endcan

        <li class="{{Request::is('user_management/*') ? 'active' : ''}} mt-2"><a><i class="fa-solid fa-note-sticky"></i>Lottery<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu" style="{{Request::is('user_management/*') ? 'display: block' : ''}}">

            @can('user_management.permissions')
            <li class="{{Request::is('user_management/permission/*') ? 'current-page' : ''}}"><a href="{{route('lottery.student-entry')}}">Student Entry</a></li>
            @endcan

            @can('user_management.roles')
            <li class="{{Request::is('user_management/role/*') ? 'current-page' : ''}}"><a href="{{route('lottery.draw-lottery')}}">Draw Lottery</a></li>
            @endcan

            @can('user_management.users')
            <li class="{{Request::is('user_management/user/*') ? 'current-page' : ''}}"><a href="{{route('lottery.result')}}">Lottery Result</a></li>
            @endcan
          </ul>
        </li>
       

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