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


    <h5 class="font-15"> ★ Group Leader -05/{{ $users->total > 5 ? 5 : $users->total }}</h5>
    <h5 class="font-15"> ★ Unit Leader-25/{{ $users->total > 25 ? 25 : $users->total }}</h5>
    <h5 class="font-15"> ★ Team Leader-125/{{ $users->total > 125 ? 125 : $users->total }}</h5>
    <h5 class="font-15"> ★ Generation Leader-625/{{ $users->total > 625 ? 625 : $users->total }}</h5>
    <h5 class="font-15"> ★ Ward Leader-3125/{{ $users->total > 3125 ? 3125 : $users->total }}</h5>
    <h5 class="font-15"> ★ Union Leader-15625/{{ $users->total > 15625 ? 15625 : $users->total }}</h5>
    <h5 class="font-15"> ★ Prime Leader- 78125/{{ $users->total > 78125 ? 78125 : $users->total }}</h5>
    <h5 class="font-15"> ★ District Leader-390625/{{ $users->total > 390625 ? 390625 : $users->total }}</h5>
    <h5 class="font-15"> ★ Division Leader-1953125/{{ $users->total > 1953125 ? 1953125 : $users->total }}</h5>
    <h5 class="font-15"> ★ Country Leader-9765625/{{ $users->total > 9765625 ? 9765625 : $users->total }}</h5>
    <h5 class="font-15"> ★ Super Leader- 48828125/{{ $users->total > 48828125 ? 48828125 : $users->total }}</h5>

  
@endsection
