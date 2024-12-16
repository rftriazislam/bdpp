@extends('backend.main.main')
@section('css')
@endsection
@section('content')
    <form action="{{ route('admin.update.setting') }}" enctype="multipart/form-data" method="POST" id="myForm">
        @csrf
        <div class="card" style="margin-top:-40px;">
            <div class="card-header">
                <h4>Company Setting</h4>
            </div>

            <div class="card-body " style="padding-top: 0px;padding-bottom: 0px;">
                <div class="form-row">



                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="name">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="name"
                            placeholder="setting name" value="{{ $setting->company_name }}" required>
                    </div>

                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="title">Logo (100px X 200px)</label>
                        <input type="file" name="logo" class="form-control" id="title" placeholder="Image"
                            value="{{ $setting->image }}">
                        <img src="{{ asset('uploads/logo') }}/{{ $setting->logo }}" style="height: 40px;width:40px"
                            alt="Profile Image" />
                    </div>

                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="description">Address</label>

                        <input type="text" name="address" class="form-control" id="description" placeholder="address"
                            value="{{ $setting->address }}" required>
                    </div>

                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header">
                <h4> Contact</h4>
            </div>

            <div class="card-body " style="padding-top: 0px;padding-bottom: 0px;">
                <div class="form-row">



                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="name">Phone number</label>
                        <input type="text" name="phone" class="form-control" id="name" placeholder="setting name"
                            value="{{ $setting->phone }}" required>
                    </div>
                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="name">Whatsapp number</label>
                        <input type="text" name="whatsapp_number" class="form-control" id="name"
                            placeholder="setting name" value="{{ $setting->whatsapp_number }}" required>
                    </div>
                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="name">Telegram number</label>
                        <input type="text" name="telegram_number" class="form-control" id="name"
                            placeholder="setting name" value="{{ $setting->telegram_number }}" required>
                    </div>



                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="description">Email</label>

                        <input type="text" name="email" class="form-control" id="description" placeholder="description"
                            value="{{ $setting->email }}" required>
                    </div>

                </div>
            </div>



        </div>
        <div class="card">
            <div class="card-header">
                <h4>Social Link</h4>
            </div>

            <div class="card-body " style="padding-top: 0px;padding-bottom: 0px;">
                <div class="form-row">



                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="name">Facebook</label>
                        <input type="text" name="fb_link" class="form-control" id="name" placeholder="setting name"
                            value="{{ $setting->fb_link }}" required>
                    </div>



                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="description">Facbook page</label>

                        <input type="text" name="description" class="form-control" id="description"
                            placeholder="fb_page" value="{{ $setting->fb_page }}" required>
                    </div>
                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="description">Whatsapp</label>

                        <input type="text" name="whatapps_link" class="form-control" id="description"
                            placeholder="whatapps link" value="{{ $setting->whatapps_link }}" required>
                    </div>
                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="description">Twitter</label>

                        <input type="text" name="twitter_link" class="form-control" id="description"
                            placeholder="twitter link" value="{{ $setting->whatapps_link }}" required>
                    </div>
                    <div class="form-group col-md-3" style="margin-bottom: 15px;;">
                        <label for="description">Linkdin</label>

                        <input type="text" name="linkdin_link" class="form-control" id="description"
                            placeholder="whatapps link" value="{{ $setting->linkdin_link }}" required>
                    </div>

                </div>
            </div>

            <div class="card-footer " style="padding-top: 0px;padding-bottom: 5px;">
                <button class="btn btn-primary">Update</button>
            </div>

        </div>

    </form>
@endsection


@section('js')
@endsection
