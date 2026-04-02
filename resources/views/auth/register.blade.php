<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block font-bold text-sm text-slate-700 mb-1">Full Name</label>
            <input id="name" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-200 rounded-lg shadow-sm transition-all outline-none" type="text" name="name" value="{{ old('name') }}" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <div class="mt-4">
            <label for="email" class="block font-bold text-sm text-slate-700 mb-1">Email Address</label>
            <input id="email" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-200 rounded-lg shadow-sm transition-all outline-none" type="email" name="email" value="{{ old('email') }}" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-bold text-sm text-slate-700 mb-1">Password</label>
            <input id="password" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-200 rounded-lg shadow-sm transition-all outline-none" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block font-bold text-sm text-slate-700 mb-1">Confirm Password</label>
            <input id="password_confirmation" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-200 rounded-lg shadow-sm transition-all outline-none" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all transform hover:-translate-y-0.5">
                CREATE ACCOUNT <i class="fa-solid fa-user-plus ms-2"></i>
            </button>
        </div>

        <div class="mt-8 text-center border-t border-slate-100 pt-5">
            <span class="text-sm text-slate-500">Already registered?</span>
            <a class="text-sm font-bold text-slate-800 hover:text-red-600 ml-1 transition-colors" href="{{ route('login') }}">
                Sign In
            </a>
        </div>
    </form>
</x-guest-layout>