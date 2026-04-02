<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block font-bold text-sm text-slate-700 mb-1">Email Address</label>
            <input id="email" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-200 rounded-lg shadow-sm transition-all outline-none" type="email" name="email" value="{{ old('email') }}" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <div class="mt-5">
            <label for="password" class="block font-bold text-sm text-slate-700 mb-1">Password</label>
            <input id="password" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-200 rounded-lg shadow-sm transition-all outline-none" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <div class="flex items-center justify-between mt-5">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-red-600 shadow-sm focus:ring-red-500 cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-slate-600 font-medium">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-red-600 hover:text-red-800 transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all transform hover:-translate-y-0.5">
                SECURE LOGIN <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
            </button>
        </div>
        
        <div class="mt-8 text-center border-t border-slate-100 pt-5">
             <span class="text-sm text-slate-500">New to Radio Mahananda?</span>
             <a href="{{ route('register') }}" class="text-sm font-bold text-slate-800 hover:text-red-600 ml-1 transition-colors">Create Account</a>
        </div>
    </form>
</x-guest-layout>