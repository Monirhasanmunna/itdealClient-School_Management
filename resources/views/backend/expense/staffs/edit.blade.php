@extends('app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .no-preview{
        width: 70px;
        height: 70px;
        border-radius: 5px;
        background-color: #a4a4a4;
        padding-top: 28px;
        color: #e6e6e6
      }

      .no-preview small{
        font-size: 11px;
      }

      .previewImg{
        width: 70px;
        height: 70px;
        border-radius: 5px;
      }
</style>
@endpush

@push('title')
    Edit Student
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 26px;">Staff Edit</h2>
                <div class="text-right pt-2">
                    <a class="btn btn-secondary" href="{{route('staff.index')}}"><i class="fa-solid fa-arrow-left mr-2" style="font-size: 18px"></i>Back</a>
                </div>
            </div>
        </div>

        <form action="/hrm/staff/update/{{$staff->id}}" method="POST" id="staffInfo" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="" id="form_wrapper">
            <div class="x_panel">
            <div class="x_content">
                <h2 style="font-size: 22px;">Staff Info :</h2>
                    <div class="row mt-4">
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control selectTwodepartment">
                                    <option></option>
                                    @foreach ($departments as $department)
                                       <option {{ $department->id == $staff->department_id ? 'selected' : '' }} value="{{$department->id}}">{{$department->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select name="designation" id="designation" class="form-control selectTwoDesignation">
                                    @foreach ($staff->department->designations as $designation)
                                        <option {{ $designation->id == $staff->designation_id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="name">Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="name" name="name" value="{{$staff->name}}" class="form-control" placeholder="Enter name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="phone_number">Phone Number <span class="text-small text-danger">*</span></label>
                                <input type="text" id="phone_number" name="phone" value="{{$staff->phone}}" class="form-control" placeholder="Enter phone number">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="dob">Date Of Birth <span class="text-small text-danger">*</span></label>
                                <input type="date" name="dob" value="{{$staff->dob}}" id="dob" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                            <label for="religion">Religion <span class="text-small text-danger">*</span></label>
                            <select name="religion" id="religion" class="form-control">
                                <option {{$staff->religion == 'Islam' ? 'selected' : ''}} value="Islam">Islam</option>
                                <option {{$staff->religion == 'Hinduism' ? 'selected' : ''}} value="Hinduism">Hinduism</option>
                                <option {{$staff->religion == 'Buddist' ? 'selected' : ''}} value="Buddist">Buddist</option>
                                <option {{$staff->religion == 'Christian' ? 'selected' : ''}} value="Christian">Christian</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="gender">Gender <span class="text-small text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-control">
                                    <option {{$staff->gender == 'Male' ? 'selected' : ''}} value="Male">Male</option>
                                    <option {{$staff->gender == 'Female' ? 'selected' : ''}} value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="blood_group">Blood Group <span class="text-small text-danger">*</span></label>
                                <select name="blood_group" id="blood_group" class="form-control">
                                    <option {{$staff->blood_group == 'A+' ? 'selected' : ''}} value="A+">A+ve</option>
                                    <option {{$staff->blood_group == 'A-' ? 'selected' : ''}} value="A-">A-ve</option>
                                    <option {{$staff->blood_group == 'B+' ? 'selected' : ''}} value="B+">B+ve</option>
                                    <option {{$staff->blood_group == 'B-' ? 'selected' : ''}} value="B-">B-ve</option>
                                    <option {{$staff->blood_group == 'AB+' ? 'selected' : ''}} value="AB+">AB+ve</option>
                                    <option {{$staff->blood_group == 'AB-' ? 'selected' : ''}} value="AB-">AB-ve</option>
                                    <option {{$staff->blood_group == 'O+' ? 'selected' : ''}} value="O+">O+ve</option>
                                    <option {{$staff->blood_group == 'O-' ? 'selected' : ''}} value="O-">O-ve</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="father_name">Father's Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="father_name" name="father_name" value="{{$staff->father_name}}" class="form-control" placeholder="Enter father's name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="mother_name">Mother's Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="mother_name" name="mother_name" value="{{$staff->mother_name}}" class="form-control" placeholder="Enter mother's name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="file">Image</label>
                                <div class="custom-file form-control" style="border: none">
                                    <input type="file" name="image" class="custom-file-input" id="imageInput" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="imageInput">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="d-flex ">
                                <div class="no-preview text-center {{$staff->image ? 'd-none' : ''}}" id="no-preview">
                                    <small>No Preview</small>
                                </div>
                                @if ($staff->image)
                                  <img class="previewImg" id="imagePreview" src="{{asset($staff->image)}}" alt="" srcset="">
                                @else
                                    <img class="previewImg d-none" id="imagePreview" src="" alt="" srcset="">
                                @endif
                                
                            </div>
                        </div>
                    </div>
            </div>
            </div>

            <div class="x_panel">
            <div class="x_content">
              <h2 style="font-size: 22px;">Address :</h2>
                <div class="row mt-3">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="district">District <span class="text-small text-danger">*</span></label>
                            <input type="text" id="district" name="district" value="{{$staff->district}}" class="form-control" placeholder="Enter district name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="upazila">Upazila <span class="text-small text-danger">*</span></label>
                            <input type="text" id="upazila" name="upazila" value="{{$staff->upazila}}" class="form-control" placeholder="Enter upazila name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="post_office">Post office <span class="text-small text-danger">*</span></label>
                            <input type="text" id="post_office" name="post_office" value="{{$staff->post_office}}" class="form-control" placeholder="Enter post office name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="village">Village <span class="text-small text-danger">*</span></label>
                            <input type="text" id="village" name="village" value="{{$staff->village}}" class="form-control" placeholder="Enter village name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-paper-plane mr-1"></i>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        </form>
      </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('.selectTwodepartment').select2({
            placeholder: "Select department",
            allowClear: true,
        });

        $('.selectTwoDesignation').select2({
            placeholder: "Select designation",
            allowClear: true,
        });
    });
</script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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


    $("#staffInfo").submit(function(e){
        e.preventDefault();

        const formData = new FormData(this);
        const url = $(this).attr('action');

        $.ajax({
            url : url,
            type : "POST",
            dataType : "JSON",
            data : formData,
            processData: false,
            contentType: false,
            success : (response)=>{
                if(response.status === 200){
                    toastr.success(`${response.message}`);
                    closeTab(response.message);
                }
            },
            error : (error)=>{
                console.log(error);
            }
        })
    });


    function closeTab(msg){
        Swal.fire({
        title: msg,
        text: "Do you want close this tab?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, close it!"
        }).then((result) => {
        if (result.isConfirmed) {
                window.close();
            }
        });
    }


    $(document).ready(function() {
        $('#imageInput').change(function() {
            const file = this.files[0];
            if (file) {
            const reader = new FileReader();

            reader.onload = function(event) {
                $('#imagePreview').attr('src', event.target.result).removeClass('d-none');
                $("#no-preview").addClass('d-none');
            };

            reader.readAsDataURL(file);
            } else {
            $('#imagePreview').attr('src', '#').addClass('d-none');
            $("#no-preview").removeClass('d-none');
            }
        });
    });
</script>

@endpush