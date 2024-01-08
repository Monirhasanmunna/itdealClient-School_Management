@extends('app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('title')
    Staff
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 26px;">Staff List</h2>
            </div>
        </div>

        <div class="x_panel">
            <div class="mb-4 d-flex justify-content-between">
                <h2 style="font-size: 20px;">Search Staff</h2> 


                <div class="text-right pt-2">
                    {{-- <a class="btn btn-info" href="{{route('student.multiple-create')}}"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>Upload Student</a> --}}
                    <a class="btn btn-success" href="{{route('staff.create')}}"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>Add Student</a>
                </div>
            </div>

            <form method="POST" id="filter_form">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="class">Department</label>
                            <select name="department" id="department" class="form-control selectTwoDepartment">
                                <option></option>
                                @foreach ($departments as $department)
                                   <option value="{{$department->id}}">{{$department->name}}</option> 
                                @endforeach
                            </select>
                            <small id="errorMessage" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <select name="designation" id="designation" class="form-control selectTwoDesignation" disabled>
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
                    <th class="column-title">Department</th>
                    <th class="column-title">Designation</th>
                    <th class="column-title">Father's Name</th>
                    <th class="column-title">Mother's Name</th>
                    <th class="column-title">Mobile No.</th>
                    <th class="column-title">Gender</th>
                    <th class="column-title">B/G</th>
                    <th class="column-title">Address</th>
                    <th class="column-title text-center">Image</th>
                    <th class="column-title no-link last text-center" width='10%'><span class="nobr">Action</span></th>
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
        $('.selectTwoDepartment').select2({
            placeholder: "Select a class",
            allowClear: true,
        });

        $('.selectTwoDesignation').select2({
            placeholder: "Select a designation",
            allowClear: true,
        });
    });
</script>

<script>
    $("#department").change(function(){
        $("#errorMessage").html('');
        const department_id = $(this).val();
        
        $.ajax({
            url : `/hrm/staff/get-designations/${department_id}`,
            type : "GET",
            dataType : "JSON",
            success : (data)=>{
                console.log(data);
                if(data.length > 0){
                    let designations = `<option></option>`;
                    $.each(data,function(i,v){
                        designations += `<option value='${v.id}'>${v.name}</option>`;
                    });

                    $("#designation").html(designations);
                    $("#designation").removeAttr('disabled');
                }else{
                    $("#designation").html('');
                    $("#designation").prop('disabled', true);
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
            url : `{{route('staff.get-staff')}}`,
            type : "POST",
            dataType : "JSON",
            data : formData,
            success : (data)=>{
                let rows = '';
                $.each(data,function(i,v){
                    rows += `
                        <tr>
                            <td class="align-middle text-center">${i+1}</td>
                            <td class="align-middle">${v.name}</td>
                            <td class="align-middle">${v.department.name}</td>
                            <td class="align-middle">${v.designation.name}</td>
                            <td class="align-middle">${v.father_name}</td>
                            <td class="align-middle">${v.mother_name}</td>
                            <td class="align-middle">${v.phone}</td>
                            <td class="align-middle">${v.gender}</td>
                            <td class="align-middle">${v.blood_group}</td>
                            <td class="align-middle">${v.district}, ${v.upazila}, ${v.post_office}, ${v.village}</td>
                            <td class='align-middle text-center'>${viewImage(v.image, v.gender)}</td>
                            <td class="align-middle text-center">
                                <a href="/hrm/staff/edit/${v.id}" target="__blank" class="btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" onclick="deleteItem(${v.id})" class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                            
                        </tr>
                    `;
                });


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
                text: "Your staff has been deleted.",
                icon: "success"
                });
                    $.ajax({
                        url : `/hrm/staff/delete/${id}`,
                        type : 'GET',
                        success : (response)=>{
                            if(response.status === 200){
                                toastr.success(`${response.message}`);
                                studentFilter(storeFilter);
                            }
                        },
                    });
                }
            });
        }

</script>

@endpush