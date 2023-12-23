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
                <h2 style="font-size: 26px;">Student Create</h2>
                <div class="text-right pt-2">
                    <a class="btn btn-secondary" href="{{route('student.index')}}"><i class="fa-solid fa-arrow-left mr-2" style="font-size: 18px"></i>Back</a>
                </div>
            </div>
        </div>

        <div class="x_panel">
            <div class="mb-4 d-flex justify-content-between">
                <h2 style="font-size: 20px;"></h2>
            </div>

            <form method="POST" id="filter_form">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="session">Session</label>
                            <select name="session" id="session" class="form-control selectTwoSession">
                                <option></option>
                                @foreach ($sessions as $session)
                                   <option value="{{$session->id}}">{{$session->session_year}}</option> 
                                @endforeach
                            </select>
                            {{-- <small id="errorMessage" class="text-danger"></small> --}}
                        </div>
                    </div>
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
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-spinner mr-1"></i>Process</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <form action="{{route('student.store')}}" method="POST" id="studentInfo" enctype="multipart/form-data">
         @csrf
         <div class="d-none" id="form_wrapper">
            <div class="x_panel">
            <div class="x_content">
                <h2 style="font-size: 22px;">Student Info :</h2>
                    <div class="row mt-4">
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="roll">Roll <span class="text-small text-danger">*</span></label>
                                <input type="number" id="roll" name="roll" class="form-control" placeholder="Enter roll number">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="name">Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="phone_number">Phone Number <span class="text-small text-danger">*</span></label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Enter phone number">
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="dob">Date Of Birth <span class="text-small text-danger">*</span></label>
                                <input type="date" name="dob" id="dob" class="form-control">
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
                                <input type="text" id="father_name" name="father_name" class="form-control" placeholder="Enter father's name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="mother_name">Mother's Name <span class="text-small text-danger">*</span></label>
                                <input type="text" id="mother_name" name="mother_name" class="form-control" placeholder="Enter mother's name">
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mt-2">
                            <div class="form-group">
                                <label for="guardian_phone">Guardian Phone <span class="text-small text-danger">*</span></label>
                                <input type="text" id="guardian_phone" name="guardian_phone" class="form-control" placeholder="Enter guardian number">
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
                            <input type="text" id="district" name="district" class="form-control" placeholder="Enter district name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="upazila">Upazila <span class="text-small text-danger">*</span></label>
                            <input type="text" id="upazila" name="upazila" class="form-control" placeholder="Enter upazila name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="post_office">Post office <span class="text-small text-danger">*</span></label>
                            <input type="text" id="post_office" name="post_office" class="form-control" placeholder="Enter post office name">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="village">Village <span class="text-small text-danger">*</span></label>
                            <input type="text" id="village" name="village" class="form-control" placeholder="Enter village name">
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
        $('.selectTwoSession').select2({
            placeholder: "Select a session",
            allowClear: true,
        });

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
                    $("#section").prop('disabled', true);
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
            url : `{{route('student.academic_filter')}}`,
            type : "POST",
            dataType : "JSON",
            data : formData,
            success : (data)=>{
                $("#studentInfo").append(`
                    <input type='hidden' name='session_id' value='${data.session ? data.session : ''}' />
                    <input type='hidden' name='class_id' value='${data.class ? data.class : ''}' />
                    <input type='hidden' name='group_id' value='${data.group ? data.group : ''}' />
                    <input type='hidden' name='section_id' value='${data.section ? data.section : ''}' />
                `);

                $("#form_wrapper").removeClass('d-none');
            },

            error : (error)=>{
                $("#errorMessage").html(error.responseJSON.message);
            }
        });
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