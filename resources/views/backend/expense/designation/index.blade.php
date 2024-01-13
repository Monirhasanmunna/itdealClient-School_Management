@extends('app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
.select2-container--default .select2-selection--multiple {
    background-color: white;
    border-radius: 0px;
    cursor: text;
    padding-left: 6px;
    padding-top: 4px;
    padding-bottom: 9px;
    position: relative;
    border: 1px solid #ced4da;
}
</style>
@endpush

@push('title')
    Designation
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 26px;">Designation</h2>
            </div>
        </div>

        <div class="x_panel">
          <div class="x_title">
            <h2>Designation List</h2>

            <div class="text-right">
                <button class="btn btn-success " id="createModalBtn"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>New Create</button>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action table-bordered" id="myTable">
                <thead>
                  <tr class="headings">
                    <th class="column-title text-center" width='5%'>SL </th>
                    <th class="column-title">Designation Name</th>
                    <th class="column-title">Department</th>
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
              <h5 class="modal-title">Designation Create</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form id="form">
              @csrf
                  <div class="form-group">
                      <label for="name">Designation Name <span class="text-danger">*</span></label>
                      <input type="text" id="name" class="form-control input-default" name="name" placeholder="Enter Designation Name">
                      <span id="errorMessage" class="d-none text-danger text-small"></span>
                  </div>

                  <div class="form-group">
                    <label for="department">department's<span class="text-danger">*</span></label>
                    <select class="form-control selectTwo" name="department" style="width:100%">
                        <option></option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" rows="5" class="form-control input-default" name="description" placeholder="Enter Description Here..."></textarea>
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
              <h5 class="modal-title">Designation Edit</h5>
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
                      <button type="submit" class="btn btn-primary">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- edit Modal -->
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $("#createModalBtn").on('click',function(){
            $('#createModal').modal('show');
        })

        $('.selectTwo').select2({
            placeholder: "Select Department",
            allowClear: true,
            dropdownParent: $('#createModal')
        });
    });
</script>

<script>

    $(document).ready(function(){
        $("#form").submit(function(e){
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url : `{{route('designation.store')}}`,
                type : 'POST',
                data : formData,
                dataType : 'json',
                success : (response)=>{
                    console.log(response);
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getDesignation();
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


    getDesignation();
    async function getDesignation(){
        await $.ajax({
            url : `{{route('designation.get-designation')}}`,
            type : "GET",
            dataType : "JSON",
            success : (response)=>{
                let rows = '';
                $.each(response,function(i,v){
                    rows += `
                        <tr>
                            <td class="text-center">${i+1}</td>
                            <td>${v.name}</td>
                            <td>${v.department.name}</td>
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
                        return `<span class='badge badge-danger'>Inactive</span>`
                    }
                }

                $("#modalSpinner").addClass('d-none');
                $("#tBody").html(rows);
                $('#myTable').DataTable();
            }
        });
    }



     function editdata(id){
            $.ajax({
                url : `/hrm/designation/edit/${id}`,
                type : 'GET',
                success : (data)=>{
                    $("#modalBody").html(`
                    <div class="form-group" >
                        <label for="name">Designation Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control input-default" name="name" value='${data.name}'>
                        <span id="editErrorMessage" class=" text-danger text-small"></span>
                    </div>

                    <div class="form-group">
                        <label for="department">Department<span class="text-danger">*</span></label>
                        <select class="form-control selectTwo" name="department" style="width:100%">
                            <option></option>
                            @foreach ($departments as $department)
                                <option ${selectedDepartment(data.department, {{$department['id']}})} value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" rows="5" class="form-control input-default" name="description" placeholder="Enter Description Here...">${data.description == null ? '' : data.description}</textarea>
                    </div>

                    <div class="form-group" >
                        <label for="status">Status<span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option ${status(data.status) == 'true' ? 'selected' : ''} value="active">Active</option>
                            <option ${status(data.status) == 'false' ? 'selected' : ''} value="inactive">Inactive</option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value='${data.id}'>
                    `);

                    $("#editModal").modal('show');

                    //  select 2 initial in modal
                    $('.selectTwo').select2({
                        placeholder: "Select Department",
                        allowClear: true,
                        dropdownParent: $('#editModal')
                    });

                    function status(status){
                        if(status === 'active'){
                            return `true`;
                        }else{
                            return `false`;
                        }
                    }

                    // selected sections function
                    function selectedDepartment(department , id){
                       if(department.id == id){
                            return 'selected';
                       }else{
                            return '';
                       }
                    }
                }

            });
        }


        $("#editForm").submit(function(e){
            e.preventDefault();
           
            const updateData = $(this).serialize();

            $.ajax({
                url : `{{route('designation.update')}}`,
                type : 'POST',
                data : updateData,
                success : (response)=>{
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getDesignation();
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
                text: "Designation has been deleted.",
                icon: "success"
                });
                    $.ajax({
                        url : `/hrm/designation/delete/${id}`,
                        type : 'GET',
                        success : (response)=>{
                            if(response.status === 200){
                                toastr.success(`${response.message}`);
                                getDesignation();
                            }
                        },
                    });
                }
            });
        }


        
</script>

@endpush