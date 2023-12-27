<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Report</title>

    <style>
        .main{
            margin: 20px;
        }

        @media print {
            .page-break1 {
                page-break-after: always;
            }

            .page-break2 {
                page-break-after: always;
            }
        }

    </style>
</head>
<body>
   <div class="main">

    {{-- first page --}}

        <div class="main_page mt-3 p-5" style="background-color:rgb(195, 218, 225);height:300px;border-radius:10px;">
            <div class="d-flex">
                <div><h6>প্রতিষ্ঠানের নামঃ</h6></div>
                <div style="min-width: 500px;border-bottom:2px dotted black;margin-left:30px;"><h6>আফানউল্লাহ উচ্চ বিদ্যালয়</h6></div>
            </div>

            <div class="d-flex mt-5">
                <div class="d-flex">
                    <div><h6>শিক্ষার্থীর নামঃ</h6></div>
                    <div style="min-width: 150px;border-bottom:2px dotted black;margin-left:30px;"><h6>{{$stdnt->name}}</h6></div>
                </div>

                <div class="d-flex" style="margin-left: 60px;">
                    <div><h6>শিক্ষার্থীর আইডিঃ</h6></div>
                    <div style="min-width: 150px;border-bottom:2px dotted black;margin-left:30px;"><h6>{{$stdnt->unique_id}}</h6></div>
                </div>

            </div>

            <div class="d-flex mt-5">
                <div class="d-flex">
                    <div><h6>শ্রেণিঃ</h6></div>
                    <div style="min-width: 200px;border-bottom:2px dotted black;margin-left:30px;"><h6>{{$stdnt->class->name}}</h6></div>
                </div>

                <div class="d-flex" style="margin-left: 80px;">
                    <div><h6>শিক্ষাবর্ষঃ</h6></div>
                    <div style="min-width: 200px;border-bottom:2px dotted black;margin-left:30px;"><h6>{{$stdnt->session->session_year}}</h6></div>
                </div>

            </div>
        </div>

    <div class="page-break1"></div>

    {{-- first page --}}

    @php $counter = 0; @endphp
    <div class="row pt-3">
        <div class="x_panel pt-3" style="background-color: #EBE9E9;" id="page_wrapper">
            @foreach ($reports as $key => $report)
            @php $counter++; @endphp
            <div class="card mb-3" style="background-color: #FFFFFF !important;">
                <div class="wrapper p-4">
                    {{-- subject title --}}
                    <div class="row text-dark mb-3" style="background-color:#EBE9E9">
                        <div class="col-12 text-center py-2">
                            <h6 class="m-0">{{$key}}</h6>
                        </div>
                    </div>
                    {{-- subject title --}}

                    <div class="row">
                        @foreach ($report as $item)
                        <div class="col-4 px-2 mb-3 ">
                            <div class="box p-0 " style="border:1px solid black; background-color:#FFFFFF;color:black;min-height: 160px !important;">
                                <div class="title py-1 text-center" style="border-bottom: 1px solid black">
                                    <h6 class="m-0">{{$item->chapter->name}}</h6>
                                </div>
    
                            
                                <div class="box-body px-1 d-flex justify-content-center align-items-center text-center" style="height:94.5px;">
                                    <p style="font-size: 13px;">{{$item->chapter->description}}</p>
                                </div>
    
                                <div class="box-footer" style="border-top: 1px solid black;">
                                    <div class="row m-0">
                                        <div class="col {{$item->option1 == true ? 'bg-dark' : ''}}" style=" {{$item->option1 == true ? 'border-right: 1px solid white' : 'border-right: 1px solid black'}} ;height:34px;"></div>
                                        <div class="col {{$item->option2 == true ? 'bg-dark' : ''}}" style="{{$item->option2 == true ? 'border-right: 1px solid white' : 'border-right: 1px solid black'}}"> </div>
                                        <div class="col {{$item->option3 == true ? 'bg-dark' : ''}}" style="{{$item->option3 == true ? 'border-right: 1px solid white' : 'border-right: 1px solid black'}}"></div>
                                        <div class="col {{$item->option4 == true ? 'bg-dark' : ''}}" style="{{$item->option4 == true ? 'border-right: 1px solid white' : 'border-right: 1px solid black'}}"></div>
                                        <div class="col {{$item->option5 == true ? 'bg-dark' : ''}}" style="{{$item->option5 == true ? 'border-right: 1px solid white' : 'border-right: 1px solid black'}}"></div>
                                        <div class="col {{$item->option6 == true ? 'bg-dark' : ''}}" style="{{$item->option6 == true ? 'border-right: 1px solid white' : 'border-right: 1px solid black'}}"></div>
                                        <div class="col {{$item->option7 == true ? 'bg-dark' : ''}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if ($counter % 2 == 0)
                <div class="page-break2"></div>
            @endif
            @endforeach
        </div>
    </div>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        window.print()
    </script>
</body>
</html>