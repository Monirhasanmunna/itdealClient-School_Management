@extends('app')

@push('style')
    
@endpush

@push('title')
    Academic Year
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        @include('backend.student.setting.subnav')

        <div class="x_panel">
          <div class="x_title">
            <h2>Academic Years <small>All academic year list here</small></h2>

            <div class="text-right">
                {{-- <a href="{{route('userManagement.role.create')}}" class="btn btn-success"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>Add New</a> --}}
                {{-- <button class="btn btn-success " data-toggle="modal" data-target="#basicModal"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>New Create</button> --}}
            </div>
            <div class="clearfix"></div>
          </div>

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
                    @foreach ($sessions as $session)
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
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>


<!-- store Modal -->
<div class="modal fade" id="basicModal">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Role Create</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form id="form">
              @csrf
                  <div class="form-group">
                      <label for="name">Name <span class="text-danger">*</span></label>
                      <input type="text" id="name" class="form-control input-default" name="name" placeholder="Enter name">
                      <span id="errorMessage" class="d-none text-danger text-small"></span>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
      </div>
  </div>
</div>
<!-- store Modal -->


<!-- edit Modal -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Role Edit</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div id="modalForm">
              <form id="editForm">
                  @csrf
                  <div class="modal-body" id="modalBody">
                      <div class="form-group" id="formInput">

                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- edit Modal -->
@endsection

@push('js')
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