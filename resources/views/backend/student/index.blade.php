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
                <h2 style="font-size: 26px;">Student List</h2>
            </div>
        </div>

        <div class="x_panel">
            <div class="mb-4 d-flex justify-content-between">
                <h2 style="font-size: 20px;">Search Student</h2> 

                <div class="text-right pt-2">
                    <a class="btn btn-success" href="{{route('student.create')}}"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>Add Student</a>
                </div>
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

        <div class="x_panel">
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action table-bordered" id="">
                <thead>
                  <tr class="headings">
                    <th class="column-title text-center" width='5%'>SL </th>
                    <th class="column-title">Academic Year</th>
                    <th class="column-title">Status</th>
                    <th class="column-title no-link last text-center" width='10%'><span class="nobr">Action</span></th>
                  </tr>
                </thead>

                <tbody id="tBody">
                    
                </tbody>
              </table>

              <div class="my-3" id="modalSpinner">
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
                    let sections = '';
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
                    let groups = '';
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


    $("#filter_form").submit(function(e){
        e.preventDefault();
        
        const formData = $(this).serialize();
       
        $.ajax({
            url : `{{route('student.filter')}}`,
            type : "POST",
            dataType : "JSON",
            data : formData,
            success : (data)=>{
                console.log(data);
            },

            error : (error)=>{
                $("#errorMessage").html(error.responseJSON.message);
            }
        });
    });



    // getSessions();
    async function getSessions(){
        await $.ajax({
            url : `{{route('student.setting.session.get-sessions')}}`,
            type : "GET",
            dataType : "JSON",
            success : (response)=>{
    
                let rows = '';
                $.each(response,function(i,v){
                    rows += `
                        <tr>
                            <td class="text-center">${i+1}</td>
                            <td>${v.session_year}</td>

                            <td>${status(v.status)}</td>

                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="editdata(${v.id})" class="btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" onclick="deleteItem(${v.id})" class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });

                function status(status){
                    if(status === 'active'){
                       return `<span class='badge badge-primary'>Active</span>`
                    }else{
                        return `<span class='badge badge-danger'>Active</span>`
                    }
                }

                $("#modalSpinner").addClass('d-none');
                $("#tBody").html(rows);

            }
        });
    }


        function deleteItem(id){
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
                });
                    $.ajax({
                        url : `/student/initial-setup/academic-year/delete/${id}`,
                        type : 'GET',
                        success : (response)=>{
                            if(response.status === 200){
                                toastr.success(`${response.message}`);
                                getSessions();
                            }
                        },
                    });
                }
            });
        }

</script>

@endpush