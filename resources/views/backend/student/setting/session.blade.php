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
            <h2>Academic Years</h2>

            <div class="text-right">
                <button class="btn btn-success " data-toggle="modal" data-target="#createModal"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>New Create</button>
            </div>
            <div class="clearfix"></div>
          </div>

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


<!-- store Modal -->
<div class="modal fade" id="createModal">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Session Create</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form id="form">
              @csrf
                  <div class="form-group">
                      <label for="name">Name <span class="text-danger">*</span></label>
                      <input type="text" id="name" class="form-control input-default" name="session_year" placeholder="Enter Session">
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
              <h5 class="modal-title">Session Edit</h5>
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
                      <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $("#sessionNav").addClass('activeNav');
    $(document).ready(function(){
        $("#form").submit(function(e){
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url : `{{route('student.setting.session.store')}}`,
                type : 'POST',
                data : formData,
                dataType : 'json',
                success : (response)=>{
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getSessions();
                        $("#createModal").modal('hide');
                        $("#createModal").find("#form")[0].reset();
                    }
                },
                error : (error)=>{
                    if(error){
                       $("#errorMessage").html(error.responseJSON.message);
                       $("#errorMessage").removeClass('d-none');
                       $("#createModal").modal('show'); 
                    }
                }
            });
        });
    });


    getSessions();
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



     function editdata(id){
            $.ajax({
                url : `/student/initial-setup/academic-year/edit/${id}`,
                type : 'GET',
                success : (data)=>{
                    $("#formInput").html(`
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control input-default" name="session_year" value='${data.session_year}'>
                        <span id="editErrorMessage" class=" text-danger text-small"></span>

                        <input type="hidden" name="id" value='${data.id}'>
                    `);

                    $("#editModal").modal('show');
                }

            });
        }


        $("#editForm").submit(function(e){
            e.preventDefault();
           
            const updateData = $(this).serialize();

            $.ajax({
                url : `{{route('student.setting.session.update')}}`,
                type : 'POST',
                data : updateData,
                success : (response)=>{
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getSessions();
                        $("#editModal").modal('hide');
                    }
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