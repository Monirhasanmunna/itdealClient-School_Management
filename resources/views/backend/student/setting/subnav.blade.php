<div class="x_panel">
    <div class="x_content">
      <div class="bs-example-popovers">
          @can('student.setting.academic year')
          <a class="btn btn-primary text-white" href="{{route('student.setting.session.index')}}">Academic Years</a>
          @endcan
          @can('student.setting.class')
          <a class="btn  ">Class</a>
          @endcan
          @can('student.setting.shift')
          <a class="btn  ">Shift</a>
          @endcan
          @can('student.setting.section')
          <a class="btn  ">Section</a>
          @endcan
          @can('student.setting.group')
          <a class="btn  ">Group</a>
          @endcan
          @can('student.setting.student category')
          <a class="btn  ">Student Category</a>
          @endcan
      </div>
    </div>
</div>