@extends('backend.main.main')

@section('content')
    <div class="row">
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
                                    <th style='text-align: left;'>Sl No</th>
                                    <th style='text-align: left;'>Role</th>
                                    <th style='text-align: left;'>Name</th>
                                    <th style='text-align: left;'>Email</th>
                                    <th style='text-align: left;'> Phone</th>
                                    <th style='text-align: left;'>Status</th>
                                    {{-- <th style='text-align: left;'>Action</th> --}}

                                </tr>
                                @forelse ($users as $slider)
                                    <tr>
                                        <td> {{ $slider->id }} </td>
                                        <td>{{ $slider->role }} </td>
                                        <td>{{ $slider->name }} </td>
                                        {{-- <td>

                                        <img src="{{ asset('uploads/slider') }}/{{ $slider->image }}"
                                            style="height: 40px;width:40px" alt="Profile Image" />

                                    </td> --}}
                                        <td>{{ $slider->email }} </td>
                                        <td>{{ $slider->phone }} </td>
                                        <td>

                                            <a class="btn  text-white btn-primary"> Active </a>
                                         
                                        </td>

                                        {{-- <td>
                                     
                                        <a href=""
                                            class="btn btn-danger">
                                            Delete </a>
                                    </td> --}}
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
