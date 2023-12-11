@extends('app')

@push('css')

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
@endsection

@push('js')
    <script>
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
                        if(response.length > 0){

                            $.each(response,function(i,v){
                                winRows += `
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
                        console.log(response);
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
    </script>
@endpush