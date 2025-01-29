@extends('frontend.main.main')
@section('css')
@endsection
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <img alt="image" src="{{ asset('backend/assets/img/banner/1.png') }}"
                                    class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="#"> {{ auth()->user()->name }}</a>
                                </div>
                                <div class="author-box-job">Rank 1</div>
                                <div class="author-box-job">Balance: {{ auth()->user()->balance }}</div>
                            </div>
                            <div class="text-center">
                                <div class="author-box-description">
                                    <p>
                                        {{ auth()->user()->about }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Birthday
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->created_at }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->phone }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Mail
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->email }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Address
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#"> {{ auth()->user()->address }}</a>
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Address Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        District
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->city }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Thana
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->thana }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        City/Union/Pouroshava
                                    </span>
                                    <span class="float-right text-muted">
                                        {{-- {{ auth()->user()->union }} --}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Word
                                    </span>
                                    <span class="float-right text-muted">
                                        {{-- <a href="#"> {{ auth()->user()->word }}</a> --}}
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Current Address </h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Country
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ auth()->user()->country }}
                                    </span>
                                </p>

                                <p class="clearfix">
                                    <span class="float-left">
                                        Bio
                                    </span>
                                    <span class="float-right text-muted">
                                        {{-- {{ auth()->user()->bio }} --}}
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header">
                            <h4>Skills</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">Total Win</div>
                                    </div>
                                    <div class="media-progressbar p-t-10">
                                        0
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">Total Lose </div>
                                    </div>
                                    <div class="media-progressbar p-t-10">
                                        0
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">Total Participate</div>
                                    </div>
                                    <div class="media-progressbar p-t-10">
                                        0
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about"
                                        role="tab" aria-selected="true">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                        aria-selected="false">Setting</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#passwordchan"
                                        role="tab" aria-selected="false">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel"
                                    aria-labelledby="home-tab2">

                                    <p class="m-t-30"> Your name </p>



                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                    <form action="{{ route('user.profileUpdate') }}" enctype="multipart/form-data"
                                        method="post" id="myForm">
                                        @csrf
                                        <div class="card-header">
                                            <h4>Edit Profile</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-7   col-12">
                                                    <label> Name</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ auth()->user()->name }}" name="name">
                                                    <div class="invalid-feedback">
                                                        {{ auth()->user()->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label>Phone</label>
                                                    <input disabled type="text" class="form-control"
                                                        value="{{ auth()->user()->phone }}">
                                                    <div class="invalid-feedback">
                                                        {{ auth()->user()->phone }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label>Email</label>
                                                    <input disabled type="email" class="form-control"
                                                        value="{{ auth()->user()->email }}">
                                                    <div class="invalid-feedback">
                                                        {{ auth()->user()->email }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label>Phone</label>
                                                    <input disabled type="tel" class="form-control"
                                                        value="{{ auth()->user()->phone }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label>Birth Day</label>
                                                    <input disabled type="email" class="form-control"
                                                        value="{{ auth()->user()->birth_day }}">
                                                    <div class="invalid-feedback">
                                                        {{ auth()->user()->birth_day }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label for="position2">Country</label>
                                                    <select id="position2" class="form-control" name="country">
                                                        <option style="color: black" disabled>Select</option>
                                                        <option style="color: black" value="Bangladesh">Bangladesh
                                                        </option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label for="district">District </label>

                                                    <select id="district"
                                                        class="form-control"
                                                        name="city"  >
                                                        <option >Select</option>
                                                        @foreach ($district as $dis )
                                                              <option value="{{$dis->zone}}">{{$dis->zone}}</option>
                                                        @endforeach
                                                      
                                                      
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label for="thana">Thana </label>

                                                    <select 
                                                        class="form-control"
                                                        name="thana" id="thana">
                                                        <option >Select</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label for="position2">City/Poeroshova/Union</label>
                                                    <select id="position2" class="form-control" name="city">
                                                        <option style="color: black" disabled>Select</option>
                                                        <option {{auth()->user()->district=='Bagerhat'}} value="Bagerhat">Bagerhat</option>
                                                        <option {{auth()->user()->district=='Bandarban'}} value="Bandarban">Bandarban</option>
                                                        <option {{auth()->user()->district=='Barguna'}} value="Barguna">Barguna</option>
                                                        <option {{auth()->user()->district=='Barisal'}} value="Barisal">Barisal</option>
                                                        <option {{auth()->user()->district=='Bhola'}} value="Bhola">Bhola</option>
                                                        <option {{auth()->user()->district=='Bogra'}} value="Bogra">Bogra</option>
                                                        <option {{auth()->user()->district=='Brahmanbaria'}} value="Brahmanbaria">Brahmanbaria</option>
                                                        <option {{auth()->user()->district=='Chandpur'}} value="Chandpur">Chandpur</option>
                                                        <option {{auth()->user()->district=='Chittagong'}} value="Chittagong">Chittagong</option>
                                                        <option {{auth()->user()->district=='Chuadanga'}} value="Chuadanga">Chuadanga</option>
                                                        <option {{auth()->user()->district=='Comilla'}} value="Comilla">Comilla</option>
                                                        <option {{auth()->user()->district=='Cox"sBazar'}} value="Cox'sBazar">Cox'sBazar</option>
                                                        <option {{auth()->user()->district=='Dhaka'}} value="Dhaka">Dhaka</option>
                                                        <option {{auth()->user()->district=='Dinajpur'}} value="Dinajpur">Dinajpur</option>
                                                        <option {{auth()->user()->district=='Faridpur'}} value="Faridpur">Faridpur</option>
                                                        <option {{auth()->user()->district=='Feni'}} value="Feni">Feni</option>
                                                        <option {{auth()->user()->district=='Gaibandha'}} value="Gaibandha">Gaibandha</option>
                                                        <option {{auth()->user()->district=='Gazipur'}} value="Gazipur">Gazipur</option>
                                                        <option {{auth()->user()->district=='Gopalganj'}} value="Gopalganj">Gopalganj</option>
                                                        <option {{auth()->user()->district=='Habiganj'}} value="Habiganj">Habiganj</option>
                                                        <option {{auth()->user()->district=='Jaipurhat'}} value="Jaipurhat">Jaipurhat</option>
                                                        <option {{auth()->user()->district=='Jamalpur'}} value="Jamalpur">Jamalpur</option>
                                                        <option {{auth()->user()->district=='Jessore'}} value="Jessore">Jessore</option>
                                                        <option {{auth()->user()->district=='Jhalokati'}} value="Jhalokati">Jhalokati</option>
                                                        <option {{auth()->user()->district=='Jhenaidah'}} value="Jhenaidah">Jhenaidah</option>
                                                        <option {{auth()->user()->district=='Khagrachari'}} value="Khagrachari">Khagrachari</option>
                                                        <option {{auth()->user()->district=='Khulna'}} value="Khulna">Khulna</option>
                                                        <option {{auth()->user()->district=='Kishoreganj'}} value="Kishoreganj">Kishoreganj</option>
                                                        <option {{auth()->user()->district=='Kurigram'}} value="Kurigram">Kurigram</option>
                                                        <option {{auth()->user()->district=='Kushtia'}} value="Kushtia">Kushtia</option>
                                                        <option {{auth()->user()->district=='Lakshmipur'}} value="Lakshmipur">Lakshmipur</option>
                                                        <option {{auth()->user()->district=='Lalmonirhat'}} value="Lalmonirhat">Lalmonirhat</option>
                                                        <option {{auth()->user()->district=='Madaripur'}} value="Madaripur">Madaripur</option>
                                                        <option {{auth()->user()->district=='Magura'}} value="Magura">Magura</option>
                                                        <option {{auth()->user()->district=='Manikganj'}} value="Manikganj">Manikganj</option>
                                                        <option {{auth()->user()->district=='Maulvibazar'}} value="Maulvibazar">Maulvibazar</option>
                                                        <option {{auth()->user()->district=='Meherpur'}} value="Meherpur">Meherpur</option>
                                                        <option {{auth()->user()->district=='Munshiganj'}} value="Munshiganj">Munshiganj</option>
                                                        <option {{auth()->user()->district=='Mymensingh'}} value="Mymensingh">Mymensingh</option>
                                                        <option {{auth()->user()->district=='Naogaon'}} value="Naogaon">Naogaon</option>
                                                        <option {{auth()->user()->district=='Narail'}} value="Narail">Narail</option>
                                                        <option {{auth()->user()->district=='Narayanganj'}} value="Narayanganj">Narayanganj</option>
                                                        <option {{auth()->user()->district=='Narsingdi'}} value="Narsingdi">Narsingdi</option>
                                                        <option {{auth()->user()->district=='Natore'}} value="Natore">Natore</option>
                                                        <option {{auth()->user()->district=='Nawabganj'}} value="Nawabganj">Nawabganj</option>
                                                        <option {{auth()->user()->district=='Netrokona'}} value="Netrokona">Netrokona</option>
                                                        <option {{auth()->user()->district=='Nilphamari'}} value="Nilphamari">Nilphamari</option>
                                                        <option {{auth()->user()->district=='Noakhali'}} value="Noakhali">Noakhali</option>
                                                        <option {{auth()->user()->district=='Pabna'}} value="Pabna">Pabna</option>
                                                        <option {{auth()->user()->district=='Panchagarh'}} value="Panchagarh">Panchagarh</option>
                                                        <option {{auth()->user()->district=='Patuakhali'}} value="Patuakhali">Patuakhali</option>
                                                        <option {{auth()->user()->district=='Pirojpur'}} value="Pirojpur">Pirojpur</option>
                                                        <option {{auth()->user()->district=='Rajbari'}} value="Rajbari">Rajbari</option>
                                                        <option {{auth()->user()->district=='Rajshahi'}} value="Rajshahi">Rajshahi</option>
                                                        <option {{auth()->user()->district=='Rangamati'}} value="Rangamati">Rangamati</option>
                                                        <option {{auth()->user()->district=='Rangpur'}} value="Rangpur">Rangpur</option>
                                                        <option {{auth()->user()->district=='Satkhira'}} value="Satkhira">Satkhira</option>
                                                        <option {{auth()->user()->district=='Shariatpur'}} value="Shariatpur">Shariatpur</option>
                                                        <option {{auth()->user()->district=='Sherpur'}} value="Sherpur">Sherpur</option>
                                                        <option {{auth()->user()->district=='Sirajganj'}} value="Sirajganj">Sirajganj</option>
                                                        <option {{auth()->user()->district=='Sunamganj'}} value="Sunamganj">Sunamganj</option>
                                                        <option {{auth()->user()->district=='Sylhet'}} value="Sylhet">Sylhet</option>
                                                        <option {{auth()->user()->district=='Tangail'}} value="Tangail">Tangail</option>
                                                        <option {{auth()->user()->district=='Thakurgaon'}} value="Thakurgaon">Thakurgaon</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Address</label>
                                                    <textarea class="form-control summernote-simple" name="address">    {{ auth()->user()->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Bio</label>
                                                    <textarea class="form-control summernote-simple" name="about">    {{ auth()->user()->about }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="passwordchan" role="tabpanel"
                                    aria-labelledby="profile-tab2">
                                    <form action="{{ route('user.profile') }}" enctype="multipart/form-data"
                                        method="get" id="myForm">
                                        {{-- @csrf --}}
                                        <div class="card-header">
                                            <h4>Edit Profile</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label> Current Password</label>
                                                    <input type="password" name="current_password" class="form-control">
                                                    <div class="invalid-feedback">
                                                        {{ auth()->user()->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label> New Password</label>
                                                    <input type="password" name="new_password" class="form-control">
                                                    <div class="invalid-feedback">
                                                        {{ auth()->user()->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label> Confirm Password</label>
                                                    <input type="password" name="confirm_password" class="form-control">
                                                    <div class="invalid-feedback">
                                                        {{ auth()->user()->name }}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function () {



        /*------------------------------------------

        --------------------------------------------

        Country Dropdown Change Event

        --------------------------------------------

        --------------------------------------------*/

        $('#district').on('change', function () {

            var zone = this.value;

            $("#thana").html('');

            $.ajax({

                url: "{{route('get-thana')}}",

                type: "POST",

                data: {

                    zone: zone,

                    _token: '{{csrf_token()}}'

                },

                dataType: 'json',

                success: function (result) {

                    $('#thana').html('<option value="">-- Select Thana --</option>');

                    $.each(result.thana, function (key, value) {

                        $("#thana").append('<option value="' + value

                            .id + '">' + value.name + '</option>');

                    });

                   

                }

            });

        });



   
    });

</script>

@endsection


@section('js')

@endsection
