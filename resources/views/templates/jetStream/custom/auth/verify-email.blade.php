<?php
addCssFile('assets/plugins/otp/otp.css');
addCssFile('assets/css/custom/custom.css');
addJavascriptFile('assets/plugins/jQuery/3.7.1/jquery-3.7.1.min.js');
addJavascriptFile('assets/plugins/sweetalert2/11.11.1/sw.js');
addJavascriptFile('assets/plugins/otp/otp.js');
addJavascriptFile('assets/js/scripts.bundle.js');
addJavascriptFile('assets/plugins/axios/1.6.8/axios.min.js');
addJavascriptFile('assets/js/auth/verify-email/verify-email.js');
$otp_class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full";
?>
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <h1 class="text-2xl text-center my-3 font-bold">Verify Email</h1>
        <div class="mb-4 px-2 text-center text-l dark:text-gray-400">
            {{ __('auth.confirmation_code_description') }}
            <div class="text-center verify-email-monospace">{{Auth::user()->email}}</div>
        </div>

        <h3 class="text-center fw-bolder">{{__('auth.enter_your_confirmation_code')}}</h3>
        <form action="{{ route('verification.verify') }}" method="post"
              class="form w-100 mt-6 verify otp-form" novalidate="novalidate" id="verify_email_form">
        @csrf
        <!--begin::Input group--->
            <div class="fv-row mb-8">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-field ltr">
                            <input type="number" min="0" max="9" data-type="otp" class="{{$otp_class}}"/>
                            <input type="number" min="0" max="9" data-type="otp" class="{{$otp_class}}" disabled/>
                            <input type="number" min="0" max="9" data-type="otp" class="{{$otp_class}}" disabled/>
                            <input type="number" min="0" max="9" data-type="otp" class="{{$otp_class}}" disabled/>
                            <input type="number" min="0" max="9" data-type="otp" class="{{$otp_class}}" disabled/>
                            <input type="hidden" name="code" maxlength="5">
                        </div>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn btn-lg btn-primary fw-bolder"
                                id="verify_email_form_submit" disabled>
                            <span class="indicator-label">{{ __('auth.verify') }}</span>
                            <span class="indicator-progress">
                                {{ __('auth.please_wait') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="text-xs text-gray-500">
            {{__('auth.did_not_received_email_description')}}
        </div>
        <div class="text-xs text-gray-500">
            {{__('auth.use_edit_profile_to_change_email_to_verify_email')}}
        </div>
        <div class="mt-2 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <x-button type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
