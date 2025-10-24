<x-guest-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>

    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>

                <x-label for="name" value="{{ __('Name') }}" />
                <x-input
                    id="name"
                    type="text"
                    name="name"
                    class="block mt-1 w-full"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input
                    id="email"
                    type="email"
                    name="email"
                    class="block mt-1 w-full"
                    :value="old('email')"
                    required
                    autocomplete="username"
                />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input
                    id="password"
                    type="password"
                    name="password"
                    class="block mt-1 w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="block mt-1 w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <!-- Terms and Privacy Policy -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <label for="terms" class="flex items-center">
                        <x-checkbox id="terms" name="terms" required />
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-green-400">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-green-400">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </span>
                    </label>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('login') }}"
                   class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-green-400 transition-colors">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
</x-guest-layout>
