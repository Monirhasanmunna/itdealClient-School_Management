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
                <h2 style="font-size: 26px;">Subject Assign to Class</h2>
            </div>
        </div>

        <div class="x_panel">
          <div class="x_title">
            <h2>Assigned Subjects</h2>

            {{-- <div class="text-right">
                <a class="btn btn-success" href="{{route('subject.assign-to-class.create')}}"><i class="fa-solid fa-square-plus mr-2" style="font-size: 18px"></i>New Create</a>
            </div> --}}
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action table-bordered" id="myTable">
                <thead>
                  <tr class="headings">
                    <th class="column-title text-center" width='5%'>SL </th>
                    <th class="column-title" width="10%">Class</th>
                    <th class="column-title" width="20%">Group</th>
                    <th class="column-title">Subjects</th>
                    <th class="column-title text-center" width='5%'>Action</th>
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

@endsection

@push('js')

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    getAssignSubjects();
    function getAssignSubjects(){
         $.ajax({
            url : `{{route('subject.assign-to-class.get-assigned-subject')}}`,
            type : "GET",
            dataType : "JSON",
            success : (response)=>{
                // console.log(response);
                let rows = '';
                $.each(response,function(i,v){
                    rows += `
                        <tr>
                            <td class="text-center align-middle">${i+1}</td>
                            <td class="align-middle">${v.name}</td>
                            <td class="align-middle">${getGroups(v)}</td>
                            <td class="align-middle">${getSubjectsByGroup(v)}</td>

                            <td class="text-center align-middle">
                                <a href="/subject/assign-to-class/edit/${v.id}" class="btn-sm btn-primary"><i class="fa-solid fa-gears"></i></a>
                            </td>
                        </tr>
                    `;
                });


                function getGroups(classes){
                    let rows = '';
                    if(classes.groups.length > 0){
                        $.each(classes.groups,function(i,v){
                            rows += `
                                <div class="row">
                                    <div class="col py-2 mt-1" style="background-color: #d1d1d1">${v.name}</div>
                                </div>
                            `;
                        });
                    }

                    return rows;
                }


                function getSubjectsByGroup(cls){
                    let rows = '';

                    if(cls.groups.length > 0){
                        $.each(cls.groups,function(index,group){
                            let subjectsInGroup = cls.subjects.filter(subject => subject.pivot.group_id == group.id);
                            
                            rows += "<div class='row'>";
                                rows += "<div class='col py-2 mt-1' style='background-color: #d1d1d1'>";
                                $.each(subjectsInGroup,function(index,subject){
                                   rows += "<span class='badge badge-primary mx-1'>" +subject.name+ "</span>" 
                                });
                                rows += "</div>"
                            rows += "</div>";

                        });
                    }

                    return rows;

                }

            
                $("#modalSpinner").addClass('d-none');
                $("#tBody").html(rows);

                //datatable inabled
                $('#myTable').DataTable();
            }
        });
    }


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