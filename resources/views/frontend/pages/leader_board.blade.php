@extends('frontend.main.main')
@section('css')
    <style>
        .ca:hover {
            border-color: purple;
            ;
        }
    </style>
@endsection
@section('content')
<h3 class="  d-flex justify-content-center">Leader Board</h3>
    <div class="row ">
        @foreach ($user as $us)
            <a class=" col-xl-4 col-lg-6 col-md-6 col-sm-6 " href=" " style="text-decoration: none">
                <div>
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <h5 class="font-15"> Name: <span style="font-weight: 300"> {{$us->name}}</span></h5>
                                        <h5 class="font-15"> ID : <span style="font-weight: 300"> {{$us->id}} </span> </h5>
                                        <h5 class="font-15"> Gen : </h5>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <h5 class="font-15">District :<span style="font-weight: 300"> {{$us->district}}</span> </h5>
                                        <h5 class="font-15">Rank :  </h5>
                                        <h5 class="font-15">Member :<span style="font-weight: 300"> {{$us->members_count}}</span> </h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
