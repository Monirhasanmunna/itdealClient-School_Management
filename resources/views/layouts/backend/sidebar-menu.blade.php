<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      @can('dashboard')
      <h3>DASHBOARD</h3>
      @endcan
      <ul class="nav side-menu">

        @can('dashboard')
           <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>  
        @endcan


        @can('subject')
          <li class="{{Request::is('subject/*') ? 'active' : ''}} mt-2"><a><i class="fa-solid fa-book"></i> Subject <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="{{Request::is('subject/*') ? 'display: block' : ''}}">

              @can('subject-create')
              <li><a href="{{route('subject.index')}}">Subject List</a></li>
              @endcan

              @can('assign-to-class')
              <li><a href="{{route('subject.assign-to-class.index')}}">Assign to Class</a></li>
              @endcan

              @can('assign-to-teacher')
              <li><a href="{{route('student.index')}}">Assign to Teacher</a></li>
              @endcan

              @can('optional-subject-assign')
              <li><a href="{{route('student.index')}}">Optional Subject Assign</a></li>
              @endcan
                
            </ul>
          </li>
        @endcan


        @can('student')
          <li class="mt-2"><a><i class="fa-solid fa-user-group"></i> Student <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none;">

                <li><a href="{{route('student.index')}}">Student List</a></li>
                <li><a href="{{route('student.report.index')}}">Report Card</a></li>
                
                @can('student.setting')
                <li><a href="{{route('student.setting.session.index')}}">Setting</a>
                @endcan
                </li>
            </ul>
          </li>
        @endcan


        @can('HRM')
          <li class="mt-2"><a><i class="fa-solid fa-user-group"></i> HRM <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none;">

                @can('Department')
                <li><a href="{{route('department.index')}}">Department List</a></li>
                @endcan

                @can('Designation')
                <li><a href="{{route('designation.index')}}">Designation</a></li>
                @endcan

                @can('Staff')
                <li><a href="{{route('staff.index')}}">Staff</a></li>
                @endcan

            </ul>

          </li>
        @endcan


        @can('Expense')
          <li class="mt-2"><a><i class="fa-solid fa-user-group"></i> Expense <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none;">

              {{-- @can('Expense List')
                <li><a href="{{route('department.index')}}">Expense List</a></li>
              @endcan --}}

              @can('Expense Category')
                <li><a href="{{route('expense.category.index')}}">Categories</a></li>
              @endcan

              @can('Expense Sub Category')
                <li><a href="{{route('designation.index')}}">Sub Categories</a></li>
              @endcan

            </ul>

          </li>
        @endcan


        @can('lottery')
          <li class="{{Request::is('lottery/*') ? 'active' : ''}} mt-2"><a><i class="fa-solid fa-note-sticky"></i>Lottery<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="{{Request::is('lottery/*') ? 'display: block' : ''}}">

              @can('lottery-student-entry')
              <li class="{{Request::is('lottery/student-entry/*') ? 'current-page' : ''}}"><a href="{{route('lottery.student-entry')}}">Student Entry</a></li>
              @endcan

              @can('draw-lottery')
              <li class="{{Request::is('lottery/draw-lottery/*') ? 'current-page' : ''}}"><a href="{{route('lottery.draw-lottery')}}">Draw Lottery</a></li>
              @endcan

              @can('lottery-result')
              <li class="{{Request::is('lottery/result/*') ? 'current-page' : ''}}"><a href="{{route('lottery.result')}}">Lottery Result</a></li>
              @endcan
            </ul>
          </li>
        @endcan



        @can('user_management')
        {{-- <h3>User Management</h3> --}}
          <li class="{{Request::is('user_management/*') ? 'active' : ''}} mt-2"><a><i class="fa-solid fa-chalkboard-user"></i> User Management <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="{{Request::is('user_management/*') ? 'display: block' : ''}}">

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