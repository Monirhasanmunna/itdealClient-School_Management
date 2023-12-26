@extends('app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
.select2-container--default .select2-selection--multiple {
    background-color: white;
    border-radius: 0px;
    cursor: text;
    padding-left: 6px;
    padding-top: 4px;
    padding-bottom: 9px;
    position: relative;
    border: 1px solid #ced4da;
}
</style>
@endpush

@push('title')
    Class List
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 22px;">Subject Assign to Class</h2>
            </div>
        </div>

        <div class="x_panel" id="subject_box">
          <div class="x_title">
            <h2>Assign Subjects to <span style="font-size: 24px;color:#27A074">({{$class->name}})</span></h2>

            <div class="text-right">
                <a class="btn btn-sm btn-secondary" href="{{route('subject.assign-to-class.index')}}"><i class="fa-solid fa-arrow-left mr-1" style="font-size: 18px"></i>Back</a>
            </div>
            <div class="clearfix"></div>
          </div>

          <form action="{{route('subject.assign-to-class.update',$class->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="x_content">
                <div class="row mb-4 {{$class->groups->count() ? '' : 'd-none'}}" >
                    <div class="col-12 mb-3 mb-md-0 col-md-3">
                        <div class="card">
                            <div class="card-header" style="background-color: #27A074">
                                <span class="text-light">Group</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select name="group" id="group" class="form-control selectTwoGroup">
                                       <option></option>
                                       <option selected value="{{@$class->groups[0]->id}}">{{@$class->groups[0]->name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    
                <div class="row">
                    <div class="col-12 mb-3 mb-md-0 col-md-3">
                        <div class="card">
                            <div class="card-header" style="background-color: #27A074">
                                <span class="text-light">Compulsory</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control selectTwo" name="subject_id[]" multiple='multiple' style="width:100%">
                                        <option></option>
                                        @foreach ($compulsory_subjects as $subject)
                                        <option {{ $class['subjects']->contains('id', $subject->id) ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-12 mb-3 mb-md-0 col-md-3">
                        <div class="card">
                            <div class="card-header" style="background-color: #27A074">
                                <span class="text-light">Optional</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control selectTwo" name="subject_id[]" multiple='multiple' style="width:100%">
                                        <option></option>
                                        @foreach ($optional_subjects as $subject)
                                        <option {{ $class['subjects']->contains('id', $subject->id) ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-12 mb-3 mb-md-0 col-md-3">
                        <div class="card">
                            <div class="card-header" style="background-color: #27A074">
                                <span class="text-light">Additional</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control selectTwo" name="subject_id[]" multiple='multiple' style="width:100%">
                                        <option></option>
                                        @foreach ($additional_subjects as $subject)
                                        <option {{ $class['subjects']->contains('id', $subject->id) ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-12 mb-3 mb-md-0 col-md-3">
                        <div class="card">
                            <div class="card-header" style="background-color: #27A074">
                                <span class="text-light">Elective</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control selectTwo" name="subject_id[]" multiple='multiple' style="width:100%">
                                        <option></option>
                                        @foreach ($elective_subjects as $subject)
                                        <option {{ $class['subjects']->contains('id', $subject->id) ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-12 col-md-2 mt-md-4">
                        <div class="submit_btn ">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
              </div>
          </form>
        </div>
      </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('.selectTwo').select2({
            placeholder: "Select Subject",
            allowClear: true,
        });

        $('.selectTwoClass').select2({
            placeholder: "Select Class",
            allowClear: true,
        });

        $('.selectTwoGroup').select2({
            placeholder: "Select a group",
            allowClear: true,
        });
    });
</script>

<script>

</script>

@endpush