@extends('layouts.app')

@section('content')
    <div class="container-fluid px-0 registration-container">
        <div class="navbar-container-sm" style="display: none">
            <a href="{{ url('/') }}" class="logo-img">
                <img src="{{ asset('/images/logo.png') }}" alt="almabet logo">
            </a>
        </div>
        <div class="row registration-container-row">
            <div class="col-12 col-md-7 d-flex justify-content-center flex-column">
                <h1 class="landing-title" id="landing-title-1">UNLIMITED</h1>
                <h1 class="landing-title" id="landing-title-2">FREEBETS,</h1>
                <h2 class="landing-title-percent">370%</h2>
                <h1 class="landing-title" id="landing-title-3">SPORTS PACK!</h1>
            </div>
            <div class="col-12 col-md-5 d-flex flex-column landing-right-section align-items-center">
                <form method="POST" action="{{ route('register') }}" class="registration-form">
                    @csrf
                    <img src="{{ asset('/images/android.png') }}" alt="android button" class="android-btn">

                    @error('error')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @endif

                    <div class="form-group">
                        <input type="text" class="reg-input @error('username') is-invalid @enderror"
                               id="username" placeholder="Username" name="username"
                               value="{{ old('username') }}" required>
                        @error('username')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="email" class="reg-input @error('email') is-invalid @enderror"
                               id="email" placeholder="Email" value="{{ old('email') }}"
                               name="email" required>
                        @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="reg-input @error('password') is-invalid @enderror"
                               id="password" placeholder="Password" name="password" required>
                        @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control reg-input @error('country_code') is-invalid @enderror"
                                id="country" name="country_code" required>
                            <option value="">Country</option>
                            @foreach(config('countries') as $key => $country)
                                <option value="{{ $key }}" {{ old('country_code') == $key ? 'selected' : '' }}>
                                    {{ $country }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_code')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control reg-input @error('currency_code') is-invalid @enderror"
                                id="currency" name="currency_code" required>
                            <option value="">Currency</option>
                            @foreach(config('currencies') as $key => $currency)
                                <option value="{{ $key }}" {{ old('currency_code') == $key ? 'selected' : '' }}>
                                    {{ $currency }}
                                </option>
                            @endforeach
                        </select>
                        @error('currency_code')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="reg-input @error('phone_number') is-invalid @enderror"
                               id="phone" placeholder="Phone Number" name="phone_number"
                               value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-check mb-3 mt-3">
                        <div class="row">
                            <div class="col-10">
                                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                                       id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">
                                    I am 18 years old and I
                                    agree with the sections.
                                </label>
                                @error('terms')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-2 term-conditions-title">
                                T&C
                            </div>
                        </div>
                    </div>
                    <span id="captcha-error-msg" class="invalid-feedback" style="display:none;">
                        <strong>Please complete the CAPTCHA</strong>
                    </span>
                    <div class="g-recaptcha mb-2" data-sitekey="{{config('app.swarm.recaptcha_v2')}}"
                         style="display: none"></div>
                    <button type="submit" class="btn registration-btn"><i>REGISTRATION</i></button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.reg-input').on('change keyup', function () {
            let allFilled = true;
            $('.reg-input').each(function () {
                if ($(this).val() === '') {
                    allFilled = false;
                }
            });
            if (allFilled) {
                $('.g-recaptcha').css('display', 'block');
            } else {
                $('.g-recaptcha').css('display', 'none');
            }
        });

        $('form').on('submit', function (event) {
            var captchaResponse = grecaptcha.getResponse();
            if (captchaResponse.length === 0) {
                event.preventDefault();
                if (captchaResponse.length === 0) {
                    event.preventDefault();
                    $('#captcha-error-msg').show();
                } else {
                    $('#captcha-error-msg').hide();
                }
            }
        });
    });
</script>


