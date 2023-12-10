@extends('app')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="x_content">
                <h2 style="font-size: 20px">Student Lottery Registration</h2>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_content">
                <div class="col-12 col-lg-6">
                    <form action="{{route('lottery.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex flex-column flex-xl-row">
                            <div class="col-12 col-xl-8">
                                <div class="form-group">
                                    <label for="file">Select file <small class="text-danger">excel file only</small></label>
                                    <div class="custom-file form-control" style="border: none">
                                        <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                      </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 27px">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="px-1">
                        <a href="/backend/file/student-registration.xlsx" class="btn btn-info" style="margin-top: 27px">Download Sample</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="x_panel">
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action table-bordered" id="datatable">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Applicant ID</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Gender</th>
                    <th class="column-title">Religion</th>
                    <th class="column-title">Fathar's Name</th>
                    <th class="column-title">Mother's Name</th>
                    <th class="column-title">Mobile No.</th>
                  </tr>
                </thead>

                <tbody>
                    @foreach ($applicants as $applicant)
                        <tr>
                            <td>{{$applicant->applicant_id}}</td>
                            <td>{{$applicant->name}}</td>
                            <td>{{$applicant->gender}}</td>
                            <td>{{$applicant->religion}}</td>
                            <td>{{$applicant->father_name}}</td>
                            <td>{{$applicant->mother_name}}</td>
                            <td>{{$applicant->phone_number}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@push('js')

@endpush