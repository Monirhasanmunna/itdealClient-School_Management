@extends('app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('title')
    Student List
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 26px;">Student Report</h2>
            </div>
        </div>

        <div class="x_panel">
            <div class="mb-4 d-flex justify-content-between">
                <h2 style="font-size: 20px;">Search Student</h2> 

                {{-- <div class="text-right pt-2">
                    <a class="btn btn-success" href="{{route('student.create')}}"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>Add Student</a>
                </div> --}}
            </div>

            <form method="POST" id="filter_form">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="class">Class</label>
                            <select name="class" id="class" class="form-control selectTwoClass">
                                <option></option>
                                @foreach ($classes as $class)
                                   <option value="{{$class->id}}">{{$class->name}}</option> 
                                @endforeach
                            </select>
                            <small id="errorMessage" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="section">Section</label>
                            <select name="section" id="section" class="form-control selectTwoSection" disabled>
                                {{-- data comes from ajax response --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="group">Group</label>
                            <select name="group" id="group" class="form-control selectTwoGroup" disabled>
                               {{-- data comes from ajax response --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div style="padding-top:27px;">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="x_panel d-none" id="tableCrad">
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action table-bordered" id="">
                <thead>
                  <tr class="headings">
                    <th class="column-title text-center" width='5%'>SL </th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Roll</th>
                    <th class="column-title">Report Print</th>
                  </tr>
                </thead>

                <tbody id="tBody">
                    
                </tbody>
              </table>

              <div class="my-3 d-none" id="modalSpinner">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('.selectTwoClass').select2({
            placeholder: "Select a class",
            allowClear: true,
        });

        $('.selectTwoSection').select2({
            placeholder: "Select a section",
            allowClear: true,
        });

        $('.selectTwoGroup').select2({
            placeholder: "Select a group",
            allowClear: true,
        });
    });
</script>

<script>
    $("#class").change(function(){
        $("#errorMessage").html('');
        const class_id = $(this).val();
        
        $.ajax({
            url : `/student/get-section-group/${class_id}`,
            type : "GET",
            dataType : "JSON",
            success : (data)=>{
                if(data.sections.length > 0){
                    let sections = `<option></option>`;
                    $.each(data.sections,function(i,v){
                        sections += `<option value='${v.id}'>${v.name}</option>`;
                    });

                    $("#section").html(sections);
                    $("#section").removeAttr('disabled');
                }else{
                    $("#section").html('');
                    $("#section").prop('disabled', true).html('');
                }

                if(data.groups.length > 0){
                    let groups = `<option></option>`;
                    $.each(data.groups,function(i,v){
                        groups += `<option value='${v.id}'>${v.name}</option>`;
                    });

                    $("#group").html(groups);
                    $("#group").removeAttr('disabled');
                }else{
                    $("#group").html('');
                    $("#group").prop('disabled', true);
                }
            }
        })
    });

    
    let storeFilter = '';

    $("#filter_form").submit(function(e){
        e.preventDefault();

        $("#tBody").html('');
        $("#tableCrad").removeClass('d-none');
        $("#modalSpinner").removeClass('d-none');
        
        const formData = $(this).serialize();
        storeFilter = formData;
        studentFilter(formData);
    });

    function studentFilter(formData){
        $.ajax({
            url : `{{route('student.filter')}}`,
            type : "POST",
            dataType : "JSON",
            data : formData,
            success : (data)=>{
                console.log(data);
                let rows = '';
                $.each(data,function(i,v){
                    rows += `
                        <tr>
                            <td class="align-middle text-center">${i+1}</td>
                            <td class="align-middle">${v.name}</td>
                            <td class="align-middle">${v.roll}</td>
                            <td class="align-middle">${reportCheck(v)}</td>
                        </tr>
                    `;
                });

                // href="/student/report/report-print/${v.id}"

                function reportCheck(v){
                    if(v.reports.length > 0){
                        return `<a href="/student/report/report-print/${v.id}" target="__blank" class="btn btn-sm btn-success">Print</a>`;
                    }else{
                        return `<a href="javascript:void(0)" onclick="reportCreate(${v.id})" class="btn btn-sm btn-primary" >Create Report</a>`;
                    }
                }


                function viewImage(image, gender){
                    if(image){
                        return `<img src='${image}' class='p-1' style='width:50px;height:50px;border:2px solid #27A074;border-radius:50%' />`
                    }else{
                        if(gender === 'Female'){
                            return `<img class='p-1' src='{{asset('backend/file/girl.png')}}' style='width:50px;height:50px;border:2px solid #27A074;border-radius:50%' />`
                        }else{
                            return `<img class='p-1' src='{{asset('backend/file/boy.png')}}' style='width:50px;height:50px;border:2px solid #27A074;border-radius:50%' />`
                        }
                    }
                }

                $("#modalSpinner").addClass('d-none');
                $("#tBody").html(rows);
            },

            error : (error)=>{
                $("#errorMessage").html(error.responseJSON.message);
            }
        });
    }


    function reportCreate(id){
        $.ajax({
            url : `/student/report/report-store/${id}`,
            type : "GET",
            dataType : "JSON",
            success : (response)=>{
                if(response.status === 200){
                    toastr.success(`${response.message}`);
                    studentFilter(storeFilter);
                }
            }
        })
    }

</script>

@endpush