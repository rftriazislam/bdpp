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
    <h3 class="  d-flex justify-content-center">Top Leader</h3>
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> User Lists</h4>

                </div>

                <div class="card-body" style="padding-top: 0px;">

                    <div class="table-responsive table-container">
                        <table class="table table-striped table-hover data-table" id="save-stage" style="width:100%;">
                            <thead>


                            </thead>
                            <tbody>

                                <tr>

                                    <th style='text-align: left;'>Name</th>
                                    <th style='text-align: left;'>District</th>
                                    <th style='text-align: left;'>Total</th>
                                    <th style='text-align: left;'> Rank</th>


                                </tr>
                                @forelse ($users as $user)
                                    <tr>
                                        <td> {{ $user->name }} </td>
                                        <td>{{ $user->thana }} </td>
                                        <td>{{ $user->total?$user->total:0 }} </td>
                                        <td>
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
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"> Empty </td>

                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
