@extends('app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('title')
Student Entry
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="x_content">
                <h2 style="font-size: 20px">Student Admission</h2>
            </div>
        </div>

        <form action="{{route('student.multiple-upload')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="x_panel">
                <div class="mb-4 d-flex justify-content-between">
                    <h2 style="font-size: 20px;"></h2>
                </div>

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
                </div>
            </div>

            <div class="x_panel">
                <div class="x_content">
                    <div class="col-12 col-lg-6">
                        <div class="row d-flex flex-column flex-xl-row">
                            <div class="col-12 col-xl-8">
                                <div class="form-group">
                                    <label for="file">Select file <small class="text-danger">excel file
                                            only</small></label>
                                    <div class="custom-file form-control" style="border: none">
                                        <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 27px">Upload</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="px-1">
                            <a href="/backend/file/student-admission.xlsx" class="btn btn-info"
                                style="margin-top: 27px">Download Sample</a>
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
    $(document).ready(function () {
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
    $("#class").change(function () {
        $("#errorMessage").html('');
        const class_id = $(this).val();

        $.ajax({
            url: `/student/get-section-group/${class_id}`,
            type: "GET",
            dataType: "JSON",
            success: (data) => {
                if (data.sections.length > 0) {
                    let sections = '';
                    $.each(data.sections, function (i, v) {
                        sections += `<option value='${v.id}'>${v.name}</option>`;
                    });

                    $("#section").html(sections);
                    $("#section").removeAttr('disabled');
                } else {
                    $("#section").html('');
                    $("#section").prop('disabled', true);
                }

                if (data.groups.length > 0) {
                    let groups = '';
                    $.each(data.groups, function (i, v) {
                        groups += `<option value='${v.id}'>${v.name}</option>`;
                    });

                    $("#group").html(groups);
                    $("#group").removeAttr('disabled');
                } else {
                    $("#group").html('');
                    $("#group").prop('disabled', true);
                }
            }
        })
    });


    $("#filter_form").submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: `{{route('student.academic_filter')}}`,
            type: "POST",
            dataType: "JSON",
            data: formData,
            success: (data) => {
                $("#studentInfo").append(`
                    <input type='hidden' name='session_id' value='${data.session ? data.session : ''}' />
                    <input type='hidden' name='class_id' value='${data.class ? data.class : ''}' />
                    <input type='hidden' name='group_id' value='${data.group ? data.group : ''}' />
                    <input type='hidden' name='section_id' value='${data.section ? data.section : ''}' />
                `);

                $("#form_wrapper").removeClass('d-none');
            },

            error: (error) => {
                $("#errorMessage").html(error.responseJSON.message);
            }
        });
    });


    $(document).ready(function () {
        $('#imageInput').change(function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function (event) {
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
