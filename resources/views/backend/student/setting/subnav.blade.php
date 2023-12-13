<div class="x_panel">
    <div class="x_content">
      <div class="bs-example-popovers">
          @can('student.setting.academic year')
          <a class="btn navBtn" id="sessionNav" href="{{route('student.setting.session.index')}}">Academic Years</a>
          @endcan
          @can('student.setting.class')
          <a class="btn navBtn" id="classNav">Class</a>
          @endcan
          @can('student.setting.section')
          <a class="btn navBtn" id="sectionNav" href="{{route('student.setting.section.index')}}">Section</a>
          @endcan
          @can('student.setting.group')
          <a class="btn navBtn" id="groupNav" href="{{route('student.setting.group.index')}}">Group</a>
          @endcan
      </div>
    </div>
</div>