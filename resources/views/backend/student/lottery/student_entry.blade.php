@extends('app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="x_content">
                <h2>Student Lottery Registration</h2>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_content">
                <div class="col-12 col-lg-8">
                    <form action="{{route('lottery.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex flex-column flex-xl-row">
                            <div class="col-12 col-xl-4">
                                <div class="form-group">
                                    <label for="session">Session</label>
                                    <select class="js-example-basic-single form-control" name="session">
                                        <option></option>
                                        @foreach ($sessions as $session)
                                            <option value="{{$session->id}}">{{$session->session_year}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label for="file">Select file <small class="text-danger">excel file only</small></label>
                                    <div class="custom-file form-control" style="border: none">
                                        <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                      </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-2">
                                <button type="submit" class="btn btn-primary mt-2 mt-lg-4">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="d-flex justify-content-lg-center px-1">
                        <a href="/backend/file/student-registration.xlsx" class="btn btn-info mt-2 mt-lg-4">Download Sample</a>
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
                    <th class="column-title text-center" width='5%'>SL </th>
                    <th class="column-title">Academic Year</th>
                    <th class="column-title">Status</th>
                    <th class="column-title no-link last text-center" width='10%'><span class="nobr">Action</span></th>
                  </tr>
                </thead>

                <tbody>
                    {{-- @foreach ($sessions as $session)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{$session->session_year}}</td>
                            <td>
                                @if ($session->status == 'active')
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-success">Inactive</span>
                                @endif
                                
                            </td>

                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="editdata({{$session->id}})" class="btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" onclick="deleteItem({{$session->id}})" class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>

                            <form action="{{route('userManagement.role.destroy',$session->id)}}" method="POST" class="d-none deleteForm-{{$session->id}}">
                              @method('PUT')
                              @csrf
                            </form>
                        </tr>
                    @endforeach --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2({
        placeholder: "Select a session",
        allowClear: true
    });
});

</script>
<script>
    $(document).ready(function(){
        $("#form").submit(function(e){
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url : '/user_management/role/store',
                type : 'POST',
                data : formData,
                dataType : 'json',
                success : (response)=>{
                    location.reload();
                },
                error : (error)=>{
                    if(error){
                       $("#errorMessage").html(error.responseJSON.message);
                       $("#errorMessage").removeClass('d-none');
                       $("#basicModal").modal('show'); 
                    }
                }
            });
        });
    });

    async function editdata(id){
           await $.ajax({
                url : `/user_management/role/edit/${id}`,
                type : 'GET',
                success : (data)=>{
                    $("#formInput").html(`
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-default" name="name" value='${data.name}'>
                            <span id="editErrorMessage" class=" text-danger text-small"></span>

                            <input type="hidden" name="data_id" value='${data.id}'>

                    `);

                    $("#editModal").modal('show');
                }

               
            });
        }


        $("#editForm").submit(function(e){
            e.preventDefault();
           
            const updateData = $(this).serialize();

            $.ajax({
                url : `/user_management/role/update/data`,
                type : 'POST',
                data : updateData,
                success : (success)=>{
                    location.reload();
                },

                error : (error)=>{
                    console.log(error.responseJSON.message);
                    $('#editErrorMessage').text(error.responseJSON.message)
                    $("#editModal").modal('show'); 
                }
            });
        });



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

                $(`.deleteForm-${id}`).submit();
            }
            });
        }
</script>

@endpush