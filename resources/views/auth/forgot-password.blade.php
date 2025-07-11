<x-guest-layout>
    <x-guest-card>
        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-custom-validation-errors />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <a href="index.html"><img src="images/logo-dark.png" class="mb-4 d-block mx-auto" alt=""></a>
            <h6 class="mb-2 text-uppercase fw-semibold">Reset your password</h6>

            <p class="text-muted">Please enter your email address. You will receive a link to create a new password via email.</p>

            <div class="mb-3">
                <label class="form-label fw-semibold">{{ __('Email') }}</label>
                <input name="email" id="email" type="email" class="form-control" placeholder="example@website.com" required autofocus autocomplete="username">
            </div>

            <button class="btn btn-primary w-100" type="submit">{{ __('Email Password Reset Link') }}</button>

            <div class="col-12 text-center mt-3">
                <span><span class="text-muted small me-2">{{ __('Remember your password ?') }} </span> <a href="{{ route('login') }}" class="text-dark fw-semibold small">{{ __('Sign in') }}</a></span>
            </div><!--end col-->
        </form>
    </x-guest-card>
</x-guest-layout>
