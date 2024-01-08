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
    Create Student
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 22px;">Staff Create</h2>
                <div class="text-right pt-2">
                    <a class="btn btn-sm btn-secondary" href="{{route('staff.index')}}"><i class="fa-solid fa-arrow-left mr-2" style="font-size: 18px"></i>Back</a>
                </div>
            </div>
        </div>


        <form action="{{route('staff.store')}}" method="POST" enctype="multipart/form-data">
         @csrf
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
                                       <option value="{{$department->id}}">{{$department->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select name="designation" id="designation" class="form-control selectTwoDesignation" disabled>
                                    {{-- data comes from ajax --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="name">Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="phone_number">Phone Number <span class="text-small text-danger">*</span></label>
                                <input type="text" id="phone_number" name="phone" value="{{old('phone_number')}}" class="form-control" placeholder="Enter phone number">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="dob">Date Of Birth <span class="text-small text-danger">*</span></label>
                                <input type="date" name="dob" value="{{old('dob')}}" id="dob" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="religion">Religion <span class="text-small text-danger">*</span></label>
                            <select name="religion" id="religion" class="form-control">
                                <option value="Islam">Islam</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Buddist">Buddist</option>
                                <option value="Christian">Christian</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="gender">Gender <span class="text-small text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="blood_group">Blood Group <span class="text-small text-danger">*</span></label>
                                <select name="blood_group" id="blood_group" class="form-control">
                                    <option value="A+">A+ve</option>
                                    <option value="A-">A-ve</option>
                                    <option value="B+">B+ve</option>
                                    <option value="B-">B-ve</option>
                                    <option value="AB+">AB+ve</option>
                                    <option value="AB-">AB-ve</option>
                                    <option value="O+">O+ve</option>
                                    <option value="O-">O-ve</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="father_name">Father's Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="father_name" name="father_name" value="{{old('father_name')}}" class="form-control" placeholder="Enter father's name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="mother_name">Mother's Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="mother_name" name="mother_name" value="{{old('mother_name')}}" class="form-control" placeholder="Enter mother's name">
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
                                <div class="no-preview text-center" id="no-preview">
                                    <small>No Preview</small>
                                </div>
                                <img class="previewImg d-none" id="imagePreview" src="" alt="" srcset="">
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
                            <input type="text" id="district" name="district" value="{{old('district')}}" class="form-control" placeholder="Enter district name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="upazila">Upazila <span class="text-small text-danger">*</span></label>
                            <input type="text" id="upazila" name="upazila" value="{{old('upazila')}}" class="form-control" placeholder="Enter upazila name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="post_office">Post office <span class="text-small text-danger">*</span></label>
                            <input type="text" id="post_office" name="post_office" value="{{old('post_office')}}" class="form-control" placeholder="Enter post office name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="village">Village <span class="text-small text-danger">*</span></label>
                            <input type="text" id="village" name="village" value="{{old('village')}}" class="form-control" placeholder="Enter village name">
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