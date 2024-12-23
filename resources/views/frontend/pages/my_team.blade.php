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
{{-- <h3 class="  d-flex justify-content-center"> My Team</h3> --}}
    <div class="row ">
        @foreach ($users as $user)
            <a class=" col-xl-4 col-lg-6 col-md-6 col-sm-6 " href=" " style="text-decoration: none">
                <div>
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <h5 class="font-15"> Name: <span style="font-weight: 300"> {{$user->name}}</span></h5>
                                        <h5 class="font-15"> ID : <span style="font-weight: 300"> {{$user->id}} </span> </h5>
                                        <h5 class="font-15"> Gen : </h5>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <h5 class="font-15">District :<span style="font-weight: 300"> {{$user->thana}}</span> </h5>
                                        <h5 class="font-15">Rank :
                                            
                                            @php
                                            if ($user->total <= 5) {
                                                echo 'Group Leader';
                                            } elseif ($user->total > 5 && $user->total <= 25) {
                                                echo 'Unit Leader';
                                            } elseif ($user->total > 25 && $user->total <= 125) {
                                                echo 'Team Leader';
                                            } elseif ($user->total > 125 && $user->total <= 625) {
                                                echo 'Generation Leader';
                                            } elseif ($user->total > 625 && $user->total <= 3125) {
                                                echo 'Ward Leader';
                                            } elseif ($user->total > 3125 && $user->total <= 15625) {
                                                echo 'Union Leader';
                                            } elseif ($user->total > 15625 && $user->total <= 78125) {
                                                echo 'Prime Leader';
                                            } elseif ($user->total > 78125 && $user->total <= 390625) {
                                                echo 'District Leader';
                                            } elseif ($user->total > 390625 && $user->total <= 1953125) {
                                                echo 'Division Leader';
                                            } elseif ($user->total > 1953125 && $user->total <= 9765625) {
                                                echo 'Country Leader';
                                            } elseif ($user->total > 9765625) {
                                                echo 'Super Leader';
                                            }
                                        @endphp
                                        
                                        </h5>
                                        <h5 class="font-15">Member :<span style="font-weight: 300"> {{$user->total}}</span> </h5>

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
