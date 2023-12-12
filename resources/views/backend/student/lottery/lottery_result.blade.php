@extends('app')

@push('css')
<style>
    @media (min-width: 1200px){
        .modal-xl {
            max-width: 1817px;
        }
    }
</style>
@endpush

@push('title')
    Lottery Result
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="x_content">
                <h2 style="font-size: 20px">Lottery Result</h2>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_content">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist" style="border-bottom:none">
                    <li class="nav-item">
                      <a class="my-btn active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Win List</a>
                    </li>
                    <li class="nav-item">
                      <a class="my-btn" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Not Win List</a>
                    </li>
                  </ul>
            </div>
        </div>

        <div class="x_panel">
          <div class="x_content">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action table-bordered">
                          <thead>
                            <tr class="headings">
                              <th class="column-title">Applicant ID</th>
                              <th class="column-title">Name</th>
                              <th class="column-title">Gender</th>
                              <th class="column-title">Religion</th>
                              <th class="column-title">Fathar's Name</th>
                              <th class="column-title">Mother's Name</th>
                              <th class="column-title">Mobile No.</th>
                              <th class="column-title text-center">Action</th>
                            </tr>
                          </thead>
          
                          <tbody id="winList">
                              
                            
                          </tbody>
          
                          <tfoot class="d-none" id="wFoot">
                              <tr>
                                  <td colspan="7" class="text-center">No Applicant Found</td>
                              </tr>
                          </tfoot>
                        </table>
                        <div class="d-none my-3" id="wSpinner">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-striped jambo_table bulk_action table-bordered">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Applicant ID</th>
                            <th class="column-title">Name</th>
                            <th class="column-title">Gender</th>
                            <th class="column-title">Religion</th>
                            <th class="column-title">Fathar's Name</th>
                            <th class="column-title">Mother's Name</th>
                            <th class="column-title">Mobile No.</th>
                          </tr>
                        </thead>
        
                        <tbody id="notWinList">
                            

                        </tbody>
        
                        <tfoot class="d-none" id="lFoot">
                            <tr>
                                <td colspan="7" class="text-center">No Applicant Found</td>
                            </tr>
                        </tfoot>
                      </table>
                      <div class="d-none my-3" id="lSpinner">
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
      </div>
</div>


{{-- show modal --}}
<div class="modal fade bs-example-modal-lg" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header text-white" style="background-color: #27A074">
          <h4 style="font-size: 27px" class="modal-title" id="myModalLabel">Selected Student Info</h4>
          <button type="button" class="close text-white" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="card">
            {{-- <div class="card-header">
                <h2 style="font-size: 25px">Student Info :</h2>
            </div> --}}
            <div class="card-body">
                <div id="studentInfo">

                </div>

                <div class="d-none my-3" id="modalSpinner">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>

            </div>
          </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-info next-btn">Next <i class="fa-solid fa-circle-arrow-right"></i></button>
        </div>

      </div>
    </div>
  </div>
{{-- show modal --}}
@endsection

@push('js')
    <script>
        let allIds = '';
        $(document).ready(function(){
            
            getSelectedApplicant();

            function getSelectedApplicant(){
                $("#winList").empty();
                $("#notWinList").empty();

                $("#wFoot").addClass('d-none');
                $("#lFoot").addClass('d-none');
                $("#wSpinner").removeClass('d-none');
                $("#lSpinner").removeClass('d-none');
                let winRows = '';
                let losRows = '';

                $.ajax({
                    url : `{{route('lottery.selected-applicant')}}`,
                    Type : 'GET',
                    dataType : "JSON",
                    success : (response)=>{
                        console.log(response);
                        allIds = response.allId;
                        if(response.applications.length > 0){

                            $.each(response.applications,function(i,v){
                                winRows += `
                                    <tr>
                                        <td>${v.applicant_id}</td>
                                        <td>${v.name}</td>
                                        <td>${v.gender}</td>
                                        <td>${v.religion}</td>
                                        <td>${v.father_name}</td>
                                        <td>${v.mother_name}</td>
                                        <td>${v.phone_number}</td>
                                        <td class='text-center'><a onclick="showItem(${v.id})" class='btn btn-sm btn-primary' href='javascript:void(0)'><i class="fa-solid fa-display"></i></a></td>
                                    </tr>
                                `
                            });

                            $("#winList").html(winRows);
                            $("#wSpinner").addClass('d-none');
                            
                        }else{
                            $("#wSpinner").addClass('d-none');
                            $("#wFoot").removeClass('d-none');
                        }
                    }
                });


                $.ajax({
                    url : `{{route('lottery.rejected-applicant')}}`,
                    Type : 'GET',
                    dataType : "JSON",
                    success : (response)=>{
                
                        if(response.length > 0){

                            $.each(response,function(i,v){
                                losRows += `
                                    <tr>
                                        <td>${v.applicant_id}</td>
                                        <td>${v.name}</td>
                                        <td>${v.gender}</td>
                                        <td>${v.religion}</td>
                                        <td>${v.father_name}</td>
                                        <td>${v.mother_name}</td>
                                        <td>${v.phone_number}</td>
                                    </tr>
                                `
                            });

                            $("#notWinList").html(losRows);
                            $("#lSpinner").addClass('d-none');
                            
                        }else{
                            $("#lSpinner").addClass('d-none');
                            $("#lFoot").removeClass('d-none');
                        }
                    }
                });
            }
        });


        let currentIndex = 0;

        $(".next-btn").on('click',function(){

            if(currentIndex < allIds.length){
                let currentId = allIds[currentIndex];
                
                showItem(currentId);
            }else{
                let item = `
                    <div class="d-flex justify-content-center justify-item-center">
                        <h1>The End</h1>
                    </div>
                `;

                $("#studentInfo").html(item);
                $(".next-btn").addClass('d-none');
            }
        });


        function showItem(id){
            let index = allIds.indexOf(id);
            currentIndex = index;
            currentIndex++;

            $("#studentInfo").empty();
            $("#modalSpinner").removeClass('d-none');
            $(".next-btn").removeClass('d-none');
            

            $.ajax({
                url :  `/lottery/selected-student/${id}/show`,
                type : "GET",
                dataType : 'JSON',
                success : (response)=>{
                    console.log(response);
                    let item = `
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th style='font-size:21px;'>Student Name</th>
                                    <td style='font-size:19px;'>${response.name}</td>
                                </tr>

                                <tr>
                                    <th style='font-size:21px;'>Aplicant No.</th>
                                    <td style='font-size:19px;'>${response.applicant_id}</td>
                                </tr>

                                <tr>
                                    <th style='font-size:21px;'>Father's Name</th>
                                    <td style='font-size:19px;'>${response.father_name}</td>
                                </tr>

                                <tr>
                                    <th style='font-size:21px;'>Mother's Name</th>
                                    <td style='font-size:19px;'>${response.mother_name}</td>
                                </tr>

                                <tr>
                                    <th style='font-size:21px;'>Gender</th>
                                    <td style='font-size:19px;'>${response.gender}</td>
                                </tr>

                                <tr>
                                    <th style='font-size:21px;'>Religion</th>
                                    <td style='font-size:19px;'>${response.religion}</td>
                                </tr>
                            </table>
                    `;

                    $("#modalSpinner").addClass('d-none');
                    $("#studentInfo").html(item);
                    $("#showModal").modal('show');

                }
            });
        }

    </script>
@endpush