<x-layout title="Inloggen">
    <x-header />

    <main class="mt-35">
        <div class="p-6 mx-auto w-2/4">
            <h1 class="text-4xl font-bold">Inloggen</h1>
            <p class="mt-4 text-lg">
                Log in met uw account om verder te gaan.
            </p>

            <form method="POST" action="" class="mt-10 space-y-8">
                @csrf

                {{-- E-mailadres --}}
                <div>
                    <label for="email" class="block w-full text-base border-b-2 border-gray-300">
                        E-mailadres
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full p-3 outline-0 focus:border-2 focus:border-gray-300"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Wachtwoord --}}
                <div>
                    <label for="password" class="block w-full text-base border-b-2 border-gray-300">
                        Wachtwoord
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full p-3 outline-0 focus:border-2 focus:border-gray-300"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Extra opties --}}
                <div class="flex items-center justify-between text-sm mt-2">
                    <label class="inline-flex items-center space-x-2 cursor-pointer select-none">
                        <input
                            type="checkbox"
                            name="remember"
                            class="h-4 w-4 border-gray-400"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span>Ingelogd blijven</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-bold text-red">
                            Wachtwoord vergeten?
                        </a>
                    @endif
                </div>

                {{-- Submit --}}
                <div class="mt-8 flex items-center space-x-4">
                    <button
                        type="submit"
                        class="bg-red text-white px-8 py-3 text-lg font-bold"
                    >
                        Inloggen
                    </button>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-base font-bold text-red">
                            Nog geen account? Registreer
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </main>

    <x-footer />
</x-layout>
