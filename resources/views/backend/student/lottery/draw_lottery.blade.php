@extends('app')

@push('css')

@endpush

@push('title')
    Draw Lottery
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="x_content">
                <h2 style="font-size: 20px">Student Lottery Draw</h2>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_content">
                <div class="col-12 col-lg-12">
                    <form id="seatForm" method="POST">
                        @csrf
                        <div class="row d-flex flex-column flex-xl-row">
                            <div class="col-12 col-xl-4">
                                <div class="form-group">
                                    <label for="number_seat">Number Of Seat <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="number_of_seat" name="number_of_seat" placeholder="Number of seat">
                                    <span class="text-danger d-none" id="errorMsg"></span>
                                </div>
                            </div>
                            <div class="col-12 col-xl-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 27px">Draw</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="x_panel">
          <div class="x_content">
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

                <tbody id="tBody">
                    

                </tbody>

                <tfoot class="d-none" id="tFoot">
                    <tr>
                        <td colspan="7" class="text-center">No Applicant Found</td>
                    </tr>
                </tfoot>
              </table>
            </div>

            <div class="d-none my-3" id="spinner">
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
@endsection

@push('js')

    <script>
        $(document).ready(function(){
            $("#seatForm").submit(function(e){
                e.preventDefault();
                $("#errorMsg").addClass('d-none');
                
                const formData = $(this).serialize();

                $.ajax({
                    url         : `{{route('lottery.draw-lottery.store')}}`,
                    type        : 'POST',
                    dataType    : 'JSON',
                    data        : formData,
                    success     : (response)=>{
                        if(response){
                            if(response.status === 200){
                                toastr.success(`${response.message}`);
                                getSelectedApplicant();
                            }else{
                                toastr.error(`${response.message}`);
                            }
                        }
                    },

                    error : (error)=>{
                        console.log(error);
                        $("#errorMsg").text(error.responseJSON.message);
                        $("#errorMsg").removeClass('d-none');
                    }
                });
            });


            getSelectedApplicant();

            function getSelectedApplicant(){
                $("#tBody").empty();
                $("#tFoot").addClass('d-none');
                $("#spinner").removeClass('d-none');
                let rows = '';

                $.ajax({
                    url : `{{route('lottery.selected-applicant')}}`,
                    Type : 'GET',
                    dataType : "JSON",
                    success : (response)=>{
                        console.log(response);
                        if(response.applications.length > 0){

                            $.each(response.applications,function(i,v){
                                rows += `
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

                            $("#tBody").html(rows);
                            $("#spinner").addClass('d-none');
                            
                        }else{
                            $("#spinner").addClass('d-none');
                            $("#tFoot").removeClass('d-none');
                        }
                    }
                });
            }

        });
    </script>
@endpush