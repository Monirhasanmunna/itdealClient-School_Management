@extends('app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

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
    Class List
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 26px;">Subject</h2>
            </div>
        </div>

        <div class="x_panel">
          <div class="x_title">
            <h2>Subject List</h2>

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
                    <th class="column-title">Name</th>
                    <th class="column-title">Subject Code</th>
                    <th class="column-title">Type</th>
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
              <h5 class="modal-title">Subject Create</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form id="form">
              @csrf
                  <div class="form-group">
                      <label for="name">Name<span class="text-danger">*</span></label>
                      <input type="text" id="name" class="form-control input-default" name="name" placeholder="Enter subject name">
                      <span class="d-none nameErrorMessage text-danger text-small"></span>
                  </div>

                  <div class="form-group">
                      <label for="code">Code<span class="text-danger">*</span></label>
                      <input type="text" id="code" class="form-control input-default" name="subject_code" placeholder="Enter subject code">
                      <span class="d-none codeErrorMessage text-danger text-small"></span>
                  </div>

                  <div class="form-group">
                    <label for="name">Subject Type<span class="text-danger">*</span></label>
                    <select class="form-control selectTwo" name="subject_type" style="width:100%">
                        <option></option>
                        <option value="Compulsory">Compulsory</option>
                        <option value="Optional">Optional</option>
                        <option value="Additional">Additional</option>
                        <option value="Elective">Elective</option>
                    </select>
                    <span  class="d-none typeErrorMessage text-danger text-small"></span>
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
                <h5 class="modal-title">Class Edit</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="editForm">
                @csrf
                    
                <div id="editModalData">
                    
                </div>
  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>
<!-- edit Modal -->
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $("#createModalBtn").on('click',function(){
            $(".nameErrorMessage, .typeErrorMessage, .codeErrorMessage").addClass('d-none').text('');
            $('#createModal').modal('show');
        })

        $('.selectTwo').select2({
            placeholder: "Select Subject Type",
            allowClear: true,
            dropdownParent: $('#createModal')
        });

        // $('#myTable').DataTable();
    });
</script>

<script>

    $(document).ready(function(){
        $("#form").submit(function(e){
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url : `{{route('subject.store')}}`,
                type : 'POST',
                data : formData,
                dataType : 'json',
                success : (response)=>{
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getSubject();
                        $("#createModal").modal('hide');
                        $("#createModal").find("#form")[0].reset();
                    }
                },
                error : (error)=>{
                    console.log(error);
                    if(error.responseJSON.errors.name){
                        $(".nameErrorMessage").text(error.responseJSON.errors.name[0]);
                        $(".nameErrorMessage").removeClass('d-none');
                    }

                    if(error.responseJSON.errors.subject_code){
                        $(".codeErrorMessage").text(error.responseJSON.errors.subject_code[0]);
                        $(".codeErrorMessage").removeClass('d-none');
                    }

                    if(error.responseJSON.errors.subject_type){
                        $(".typeErrorMessage").text(error.responseJSON.errors.subject_type[0]);
                        $(".typeErrorMessage").removeClass('d-none');
                    }

                    $("#createModal").modal('show'); 
                }
            });
        });
    });


    getSubject();
    function getSubject(){
         $.ajax({
            url : `{{route('subject.get-subject')}}`,
            type : "GET",
            dataType : "JSON",
            success : (response)=>{

                let rows = '';
                $.each(response,function(i,v){
                    rows += `
                        <tr>
                            <td class="text-center">${i+1}</td>
                            <td>${v.name}</td>
                            <td>${v.subject_code}</td>
                            <td>${v.subject_type}</td>

                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="editdata(${v.id})" class="btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" onclick="deleteItem(${v.id})" class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });

                
                $("#modalSpinner").addClass('d-none');
                $("#tBody").html(rows);

                //datatable inabled
                $('#myTable').DataTable();
            }
        });
    }



     function editdata(id){
        $(".nameErrorMessage, .typeErrorMessage, .codeErrorMessage").addClass('d-none').text('');
            $.ajax({
                url : `/subject/edit/${id}`,
                type : 'GET',
                success : (data)=>{
                    console.log(data);
                    $("#editModalData").html(`
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" id="name" value='${data.name}'  class="form-control input-default" name="name" placeholder="Enter subject name">
                            <span class="d-none nameErrorMessage text-danger text-small"></span>
                        </div>

                        <div class="form-group">
                            <label for="code">Code<span class="text-danger">*</span></label>
                            <input type="text" id="code" value='${data.subject_code}' class="form-control input-default" name="subject_code" placeholder="Enter subject code">
                            <span class="d-none codeErrorMessage text-danger text-small"></span>
                        </div>

                        <div class="form-group">
                            <label for="name">Subject Type<span class="text-danger">*</span></label>
                            <select class="form-control selectTwo" name="subject_type" style="width:100%">
                                <option></option>
                                <option ${data.subject_type == 'Compulsory' ? 'selected' : ''} value="Compulsory">Compulsory</option>
                                <option ${data.subject_type == 'Optional' ? 'selected' : ''} value="Optional">Optional</option>
                                <option ${data.subject_type == 'Additional' ? 'selected' : ''} value="Additional">Additional</option>
                                <option ${data.subject_type == 'Elective' ? 'selected' : ''} value="Elective">Elective</option>
                            </select>
                            <span  class="d-none typeErrorMessage text-danger text-small"></span>
                        </div>
    
                        <input type='hidden' name='data_id' value='${data.id}' />
                    `);

                     $("#editModal").modal('show');

                    //  select 2 initial in modal
                     $('.selectTwo').select2({
                        placeholder: "Select a type",
                        allowClear: true,
                        dropdownParent: $('#editModal')
                    });

                }

            });
        }


        $("#editForm").submit(function(e){
            e.preventDefault();
           
            const updateData = $(this).serialize();

            $.ajax({
                url : `{{route('subject.update')}}`,
                type : 'POST',
                data : updateData,
                success : (response)=>{
                    console.log(response);
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getSubject();
                        $("#editModal").modal('hide');
                        $(".nameErrorMessage, .typeErrorMessage, .codeErrorMessage").addClass('d-none');
                    }
                },

                error : (error)=>{
                    console.log(error);
                    if(error.responseJSON.errors.name){
                        $(".nameErrorMessage").text(error.responseJSON.errors.name[0]);
                        $(".nameErrorMessage").removeClass('d-none');
                    }

                    if(error.responseJSON.errors.subject_code){
                        $(".codeErrorMessage").text(error.responseJSON.errors.subject_code[0]);
                        $(".codeErrorMessage").removeClass('d-none');
                    }

                    if(error.responseJSON.errors.subject_type){
                        $(".typeErrorMessage").text(error.responseJSON.errors.subject_type[0]);
                        $(".typeErrorMessage").removeClass('d-none');
                    }
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
                text: "Subject has been deleted.",
                icon: "success"
                });
                    $.ajax({
                        url : `/subject/delete/${id}`,
                        type : 'GET',
                        success : (response)=>{
                            if(response.status === 200){
                                toastr.success(`${response.message}`);
                                getSubject();
                            }
                        },
                    });
                }
            });
        }
</script>

@endpush