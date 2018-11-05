@extends('layouts.app')
@section('title','Dotinsider')
@section('content')
    <section class="bg-section full-height">
        <div class="container">
    @include('layouts.partials.header')
            <div class="contact-section to-hide">
                <p class="title-section main-title-font zigzag d-inline-block">Contact us</p>
                <div class="d-inline-block main-title-font smaller w-75 margin-20">How can we help?</div>
                <p class="main-title-font zigzag d-inline-block title-form">Contact form</p>
                <form class="d-inline-block" id="contact-form">
                    <div class="frist-input d-inline-block">
                        <input type="text" placeholder="FIRST NAME" name="first_name" minlength="3" maxlength="50" min-characters="3" max-characters="50" required>

                    </div>
                    <div class="frist-input d-inline-block">
                        <input type="text" placeholder="LAST NAME" name="last_name" minlength="3" maxlength="50" min-characters="3" max-characters="50" required>
                    </div>
                    <div class="frist-input d-inline-block phone">
                        <input type="text" pattern="[0-9]*" name="number" placeholder="PHONE NUMBER" minlength="11" maxlength="11" min-characters="11" max-characters="11" required>
                    </div>
                    <div class="frist-input d-inline-block">
                        <input type="email" placeholder="EMAIL" name="email" minlength="6" maxlength="50" min-characters="6" max-characters="50" required>
                    </div>
                    <div class="frist-input message">
                        <textarea placeholder="YOUR MESSAGE" name="message" minlength="3" maxlength="1000" min-characters="3" max-characters="1000"></textarea>
                    </div>

                    <div>
                        <button class="send" type="submit">SEND <i class="icon-arrow-right"></i></button>

                    </div>
                </form>
                <p class="message-2 main-title-font" style="display: none">Thanks for your message</p>
                <p class="main-title-font  zigzag d-inline-block title-form">contact info</p>
                <div class="d-inline-block  w-75">
                    <span>Abu Dhabi, UAE, 2454</span>
                    <span>+971 569888100</span>
                    <span>info@dotinsider.com</span>
                </div>


            </div>
        </div>
        <div class="bg-circle">
            <img src="{{assets('assets')}}/img/Elements-Circle.png" alt="">
        </div>
        <div class="bg-cuboid">
            <img src="{{assets('assets')}}/img/Elements-Cuboid.png" alt="">
        </div>
        <div class="bg-group">
            <img src="{{assets('assets')}}/img/absoluteGroup.png" alt="">
        </div>
    </section>
    @push('scripts')
        <script>

            $('#contact-form').submit(function (e) {
                $('.send').hide();
                arr = {
                    'name': $('[name="first_name"]').val(),
                    'last': $('[name="last_name"]').val(),
                    'email': $('[name="email"]').val(),
                    'number': $('[name="number"]').val(),
                    'message': $('[name="message"]').val()
                };
                e.preventDefault();
                if(validate(arr)){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "{{route('contact-us.store')}}",
                        data: arr,
                        success: function () {
                            $('#contact-form').hide(200);
                            $('.message-2').show(200);
                        },
                        error:function () {
                            alert("Internal server error")
                        }
                    })
                }
            });

            function validate(arr) {
                var valid = true;
                regex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
                name_regex =  /^[a-zA-Z\s]*$/;

                if(arr.name.length < 3 || arr.name.length > 50 || !name_regex.test(arr.name)){
                    //$('#error_first_name').show();
                    valid = false;
                }else{
                    //$('#error_first_name').hide();
                }
                if(arr.last.length < 3 || arr.last.length > 50 || !name_regex.test(arr.last)){
                   // $('#error_last_name').show();
                    valid = false;
                }else{
                   // $('#error_last_name').hide();
                }
                if(arr.number.length !== 11){
                    $('#error_number').show();
                    valid = false;
                }else{
                   // $('#error_number').hide();
                }
                if(!regex.test(arr.email)){
                   // $('#error_email').show();
                    valid = false;
                }else{
                    //$('#error_email').hide();
                }
                if(arr.message.length < 3 || arr.message.length > 1000){
                    //$('#error_message').show();
                    valid = false;
                }else{
                   // $('#error_message').hide();
                }
                return valid;
            }
        </script>
    @endpush()
@endsection
@section('footer')
@endsection
