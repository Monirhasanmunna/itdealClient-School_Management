<div class="x_panel">
    <div class="x_content">
      <div class="bs-example-popovers">
          @can('student.setting.academic year')
          <a class="btn" id="sessionNav" href="{{route('student.setting.session.index')}}">Academic Years</a>
          @endcan
          @can('student.setting.class')
          <a class="btn" id="classNav">Class</a>
          @endcan
          @can('student.setting.shift')
          <a class="btn" id="shiftNav">Shift</a>
          @endcan
          @can('student.setting.section')
          <a class="btn" id="sectionNav" href="{{route('student.setting.section.index')}}">Section</a>
          @endcan
          @can('student.setting.group')
          <a class="btn" id="groupNav">Group</a>
          @endcan
          {{-- @can('student.setting.student category')
          <a class="btn" id="categoryNav">Student Category</a>
          @endcan --}}
      </div>
    </div>
</div>