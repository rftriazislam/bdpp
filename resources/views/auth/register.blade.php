<x-guest-layout>
    <div>
        <header class=" items-center  ">
            <div class="flex justify-center ">

                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#b538cb] sm:size-16"
                    style="background:#b538cb">
                    <a class="text-white">D</a>
                </div>
            </div>
            <div class="flex justify-center ">
                <p> If you have no acount ? <a style="color:coral ;" href="{{ route('login') }}">Login</a></p>
            </div>

        </header>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="my-1 px-6 py-4 bg-white  rounded-lg " style="margin-bottom: 5px">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                        :value="old('phone')" required autofocus autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Name -->
                <div>
                    <x-input-label for="phone1" :value="__('Birth Day')" />
                    <x-text-input id="phone1" class="block mt-1 w-full" type="date" name="birth_day"
                        :value="old('birth_day')" required autofocus autocomplete="birth_day" />
                    <x-input-error :messages="$errors->get('birth_day')" class="mt-2" />
                </div>

            </div>
            <div class=" px-6 py-4 bg-white  rounded-lg " style="margin-bottom: 5px">
                {{-- <div>
                    <label for="cars">Country </label>

                    <select
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                        name="country" id="cars">
                        <option value="Bangladesh">Bangladesh</option>
                    </select>
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div> --}}
                <div>
                    <label for="district">District </label>

                    <select id="district"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                        name="city"  required>
                        <option value="" >Select</option>
                        @foreach ($district as $dis )
                              <option value="{{$dis->zone}}">{{$dis->zone}}</option>
                        @endforeach
                      
                      
                    </select>
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>
                <div>
                    <label for="thana">Thana </label>

                    <select 
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                        name="thana" id="thana" required>
                        <option value="" >Select</option>
                        
                    </select>
                    <x-input-error :messages="$errors->get('thana')" class="mt-2" />
                </div>
            </div>
            <div class=" px-6 py-4 bg-white  rounded-lg " style="margin-bottom: 5px">
                <div>
                    <x-input-label for="name" :value="__('Refer Id')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="refer_id"
                        :value="old('refer_id')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('refer_id')" class="mt-2" />
                </div>
                {{-- 
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div> --}}


                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </div>


        </form>
    </div>
</x-guest-layout>


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
