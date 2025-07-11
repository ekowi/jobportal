<x-guest-layout>
    <x-guest-card>
        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-custom-validation-errors />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <a href="home"><img src="images/logo-dark.png" class="mb-4 d-block mx-auto" alt=""></a>
            <h6 class="mb-3 text-uppercase fw-semibold">Please sign in</h6>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">{{ __('Your Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="example@website.com" value="{{ old('email') }}" required autofocus autocomplete="username">
                <x-custom-input-error for="email" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="current-password">
                <x-custom-input-error for="password" />
            </div>

            <div class="d-flex justify-content-between">
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                        <label class="form-label form-check-label text-muted" for="remember_me">{{ __('Remember me') }}</label>
                    </div>
                </div>
                @if (Route::has('password.request'))
                    <span class="forgot-pass text-muted small mb-0">
                        <a href="{{ route('password.request') }}" class="text-muted">{{ __('Forgot password?') }}</a>
                    </span>
                @endif
            </div>

            <button class="btn btn-primary w-100" type="submit">{{ __('Sign in') }}</button>

            @if (Route::has('register'))
                <div class="col-12 text-center mt-3">
                    <span>
                        <span class="text-muted me-2 small">{{ __("Don't have an account?") }}</span>
                        <a href="{{ route('register') }}" class="text-dark fw-semibold small">{{ __('Sign Up') }}</a>
                    </span>
                </div>
            @endif
        </form>
    </x-guest-card>
</x-guest-layout>
