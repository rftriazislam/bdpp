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
    <h3 class="  d-flex justify-content-center"> My Achievement</h3>


    <div class="align-items-center justify-content-between">

        <div class="p-2">
            <div class="p-2 card">
                <h4> <b >Present Rank:</b>  
                    @if ($level_1 > 5 && $level_2 < 25)
                        Group Leader
                    @elseif($level_2 > 25 && $level_3 < 125)
                        Unit Leader
                    @elseif($level_3 > 125 &&$level_4 < 625)
                        Team Leader
                    @elseif($level_4 > 625 && $level_5 < 3125)
                        Generation Leader
                    @elseif($level_5 > 3125 && $level_6 < 15625)
                        Ward Leader
                    @elseif($level_6 > 15625 && $level_7 < 78125)
                        Union Leader
                    @elseif($level_7 > 78125 && $level_8 < 390625)
                        Prime Leader
                    @elseif($level_8 > 390625 && $level_9 < 1953125)
                        District Leader
                    @elseif($level_9 > 1953125 && $level_10 < 9765625)
                        Division Leader
                    @elseif($level_10 > 9765625 && $level_11 < 48828125)
                        Country Leader
                    @elseif($level_11 > 48828125)
                        Super Leader
                    @endif
                </h4>
                <h4> <b >Next Rank : </b>
                    @if ($level_1 < 5)
                        Group Leader
                    @elseif($level_1 > 5 && $level_2 < 25)
                        Unit Leader
                    @elseif($level_2 > 25 && $level_3 < 125)
                        Team Leader
                    @elseif($level_3 > 125 && $level_4 < 625)
                        Generation Leader
                    @elseif($level_4 > 625 && $level_5 < 3125)
                        Ward Leader
                    @elseif($level_5 > 3125 && $level_6 < 15625)
                        Union Leader
                    @elseif($level_6 > 15625 && $level_7 < 78125)
                        Prime Leader
                    @elseif($level_7 > 78125 && $level_8 < 390625)
                        District Leader
                    @elseif($level_8 > 390625 && $level_9 < 1953125)
                        Division Leader
                    @elseif($level_9 > 1953125 && $level_10 < 9765625)
                        Country Leader
                    @elseif($level_10 > 9765625 && $level_11 < 48828125)
                        Super Leader
                    @elseif($level_11 > 48828125)
                        Super Leader
                    @endif
                </h4>
            </div>
        </div>

    </div>
    <div class="row p-1">
        <h5 class=" col-6">★ Group Leader -05/{{ $level_1 > 5 ? 05 : $level_1 }}</h5>
        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_1 > 5 ? 05 : $level_1) * 100) / 5 }}%">
                {{ (($level_1 > 5 ? 05 : $level_1) * 100) / 5 }}%</div>
        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ Unit Leader-25/{{ $level_2 > 25 ? 25 : $level_2 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_2 > 25 ? 25 : $level_2) * 100) / 25 }}%">
                {{ (($level_2 > 25 ? 25 : $level_2) * 100) / 25 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ Team Leader-125/{{ $level_3 > 125 ? 125 : $level_3 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_3 > 125 ? 125 : $level_3) * 100) / 125 }}%">
                {{ (($level_3 > 125 ? 125 : $level_3) * 100) / 125 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ Generation Leader-625/{{ $level_4 > 625 ? 625 : $level_4 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_4 > 625 ? 625 : $level_4) * 100) / 625 }}%">
                {{ (($level_4 > 625 ? 625 : $level_4) * 100) / 625 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ Ward Leader-3125/{{ $level_5 > 3125 ? 3125 : $level_5 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_5 > 3125 ? 3125 : $level_5) * 100) / 3125 }}%">
                {{ (($level_5 > 3125 ? 3125 : $level_5) * 100) / 3125 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class="col-6"> ★ Union Leader-15625/{{ $level_6 > 15625 ? 15625 : $level_6 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_6 > 15625 ? 15625 : $level_6) * 100) / 15625 }}%">
                {{ (($level_6 > 15625 ? 15625 : $level_6) * 100) / 15625 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ Prime Leader- 78125/{{ $level_7 > 78125 ? 78125 : $level_7 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_7 > 78125 ? 78125 : $level_7) * 100) / 78125 }}%">
                {{ (($level_7 > 78125 ? 78125 : $level_7) * 100) / 78125 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ District Leader-390625/{{ $level_8 > 390625 ? 390625 : $level_8 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_8 > 390625 ? 390625 : $level_8) * 100) / 390625 }}%">
                {{ (($level_8 > 390625 ? 390625 : $level_8) * 100) / 390625 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ Division Leader-1953125/{{ $level_9 > 1953125 ? 1953125 : $level_9 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_9 > 1953125 ? 1953125 : $level_9) * 100) / 1953125 }}%">
                {{ (($level_9 > 1953125 ? 1953125 : $level_9) * 100) / 1953125 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class="col-6"> ★ Country Leader-9765625/{{ $level_10 > 9765625 ? 9765625 : $level_10 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_10 > 9765625 ? 9765625 : $level_10) * 100) / 9765625 }}%">
                {{ (($level_10 > 9765625 ? 9765625 : $level_10) * 100) / 9765625 }}%</div>

        </div>
    </div>
    <div class="row p-1">
        <h5 class=" col-6"> ★ Super Leader- 48828125/{{ $level_11 > 48828125 ? 48828125 : $level_11 }}</h5>

        <div class="w3-light-grey col-6 " style="  border : solid green ;padding:0px">
            <div class="w3-container w3-red w3-padding w3-center"
                style="width:{{ (($level_11 > 48828125 ? 48828125 : $level_11) * 100) / 48828125 }}%">
                {{ (($level_11 > 48828125 ? 48828125 : $level_11) * 100) / 48828125 }}%</div>

        </div>
    </div>
@endsection
