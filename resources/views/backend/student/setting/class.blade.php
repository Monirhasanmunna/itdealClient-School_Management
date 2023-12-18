@extends('app')

@push('css')
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
    Class List
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        @include('backend.student.setting.subnav')

        <div class="x_panel">
          <div class="x_title">
            <h2>Group List</h2>

            <div class="text-right">
                <button class="btn btn-success " id="createModalBtn"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>New Create</button>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action table-bordered" id="">
                <thead>
                  <tr class="headings">
                    <th class="column-title text-center" width='5%'>SL </th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Group</th>
                    <th class="column-title">Section</th>
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
              <h5 class="modal-title">Class Create</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form id="form">
              @csrf
                  <div class="form-group">
                      <label for="name">Name<span class="text-danger">*</span></label>
                      <input type="text" id="name" class="form-control input-default" name="name" placeholder="Enter Class Name">
                      <span id="errorMessage" class="d-none text-danger text-small"></span>
                  </div>

                  <div class="form-group">
                    <label for="name">Section's<span class="text-danger">*</span></label>
                    <select class="form-control selectTwo" name="section_ids[]" multiple="multiple" style="width:100%">
                        <option></option>
                        @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">Group's<span class="text-danger">*</span></label>
                    <select class="form-control selectTwo2" name="group_ids[]" multiple="multiple" style="width:100%">
                        <option></option>
                        @foreach ($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
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
<script>
    $(document).ready(function() {
        $("#createModalBtn").on('click',function(){
            $('#createModal').modal('show');
        })

        $('.selectTwo').select2({
            placeholder: "Select Section's",
            allowClear: true,
            dropdownParent: $('#createModal')
        });

        $('.selectTwo2').select2({
            placeholder: "Select Group's",
            allowClear: true,
            dropdownParent: $('#createModal')
        });
    });
</script>
<script>
    
    $("#classNav").addClass('activeNav');

    $(document).ready(function(){
        $("#form").submit(function(e){
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url : `{{route('student.setting.class.store')}}`,
                type : 'POST',
                data : formData,
                dataType : 'json',
                success : (response)=>{
                    
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getClass();
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


    getClass();
    async function getClass(){
        await $.ajax({
            url : `{{route('student.setting.class.get-class')}}`,
            type : "GET",
            dataType : "JSON",
            success : (response)=>{
                console.log(response);
                let rows = '';
                $.each(response,function(i,v){
                    rows += `
                        <tr>
                            <td class="text-center">${i+1}</td>
                            <td>${v.name}</td>
                            <td>${groups(v.groups)}</td>
                            <td>${sections(v.sections)}</td>

                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="editdata(${v.id})" class="btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" onclick="deleteItem(${v.id})" class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });

                function groups(groups){
                    let group = 'N/A';
                    if(groups.length > 0){
                        group= '';
                        groups.forEach(element => {
                            group += `<span class='badge badge-primary ml-2'>${element.name}</span>`;
                        });
                    }
                    
                    return group;
                }

                function sections(sections){
                    let section = 'N/A';
                    if(sections.length > 0){
                        section = '';
                        sections.forEach(element => {
                            section += `<span class='badge badge-success ml-2'>${element.name}</span>`;
                        });
                    }
                    
                    return section;
                }

                $("#modalSpinner").addClass('d-none');
                $("#tBody").html(rows);

            }
        });
    }



     function editdata(id){
            $.ajax({
                url : `/student/initial-setup/class/edit/${id}`,
                type : 'GET',
                success : (data)=>{
                    console.log(data);
                    $("#editModalData").html(`
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" id="name" class="form-control input-default" name="name" value='${data.name}' placeholder="Enter Class Name">
                            <span id="errorMessage" class="d-none text-danger text-small"></span>
                        </div>
    
                        <div class="form-group">
                        <label for="name">Section's<span class="text-danger">*</span></label>
                        <select class="form-control selectTwo" name="section_ids[]" multiple="multiple" style="width:100%">
                            <option></option>
                            @foreach ($sections as $section)
                                <option ${selectedSection(data.sections, {{$section['id']}})} value="{{$section->id}}">{{$section->name}}</option>
                            @endforeach
                        </select>
                        </div>
    
                        <div class="form-group">
                        <label for="name">Group's<span class="text-danger">*</span></label>
                        <select class="form-control selectTwo2" name="group_ids[]" multiple="multiple" style="width:100%">
                            <option></option>
                            @foreach ($groups as $group)
                                <option ${selectedGroups(data.groups, {{$group['id']}})} value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                        </div>

                        <input type='hidden' name='data_id' value='${data.id}' />
                    `);

                     $("#editModal").modal('show');

                    //  select 2 initial in modal
                     $('.selectTwo').select2({
                        placeholder: "Select Section's",
                        allowClear: true,
                        dropdownParent: $('#editModal')
                    });

                    //  select 2 initial in modal
                    $('.selectTwo2').select2({
                        placeholder: "Select Group's",
                        allowClear: true,
                        dropdownParent: $('#editModal')
                    });


                    // selected sections function
                    function selectedSection(sections , id){
                       const sectionIds = sections.map((item)=> item.id);

                       if(sectionIds.includes(id)){
                            return 'selected';
                       }else{
                            return '';
                       }
                    }

                    // selected groups function
                    function selectedGroups(groups , id){
                       const groupIds = groups.map((item)=> item.id);
                       
                       if(groupIds.includes(id)){
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
                url : `{{route('student.setting.class.update')}}`,
                type : 'POST',
                data : updateData,
                success : (response)=>{
                    console.log(response);
                    if(response.status === 200){
                        toastr.success(`${response.message}`);
                        getClass();
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
                        url : `/student/initial-setup/class/delete/${id}`,
                        type : 'GET',
                        success : (response)=>{
                            if(response.status === 200){
                                toastr.success(`${response.message}`);
                                getClass();
                            }
                        },
                    });
                }
            });
        }
</script>

@endpush