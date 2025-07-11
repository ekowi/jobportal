<x-guest-layout>
    <x-guest-card>

        <div>
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="text-primary">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button type="submit" class="submitBnt btn btn-primary">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="
                >
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="btn btn-link text-muted p-0">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-guest-card>
</x-guest-layout>
