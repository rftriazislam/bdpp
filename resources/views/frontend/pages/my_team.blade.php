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
                                        <h5 class="font-15"> Name: <span style="font-weight: 300"> {{ $user->name }}</span>
                                        </h5>
                                        <h5 class="font-15"> ID : <span style="font-weight: 300"> {{ $user->id }}
                                            </span> </h5>
                                        <h5 class="font-15"> Gen :
                                            @php
                                                $date = new DateTime($user->birth_day);
                                                $now = new DateTime();
                                                $interval = $now->diff($date);
                                                $age = $interval->y;
                                                
                                                if ($age >= 15 && $age <= 17) {
                                                    echo 'GEN-01';
                                                } elseif ($age >= 18 && $age <= 22) {
                                                    echo 'GEN-02';
                                                } elseif ($age >= 23 && $age <= 28) {
                                                    echo 'GEN-03';
                                                } elseif ($age >= 29 && $age <= 35) {
                                                    echo 'GEN-04';
                                                } elseif ($age >= 36 && $age <= 40) {
                                                    echo 'GEN-05';
                                                } elseif ($age >= 41 && $age <= 50) {
                                                    echo 'GEN-06';
                                                } elseif ($age > 51) {
                                                    echo 'GEN-07';
                                                }
                                            @endphp


                                        </h5>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                                        <h5 class="font-15">District :<span style="font-weight: 300">
                                                {{ $user->city_name }}</span> </h5>
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
                                        <h5 class="font-15">Member :<span style="font-weight: 300">
                                                {{ $user->total }}</span> </h5>

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
