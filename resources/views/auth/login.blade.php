<x-guest-layout>
    <div class="bg-[#5c20a6] shadow-2xl rounded-[2rem] p-8 flex flex-col items-center border border-purple-500/20">
        
        <div class="flex flex-col items-center mb-8 w-full">
            <img src="{{ asset('images/logo_polis_bantuan.jpg') }}" alt="Polis Bantuan UiTM" class="h-28 mb-4 object-contain drop-shadow-md">
            
            <h2 class="text-2xl font-black text-white tracking-wide text-center uppercase">
                Polis <span class="text-[#ffcc00]">Bantuan</span>
            </h2>
            <div class="w-12 h-1 bg-[#ffcc00] mt-2 rounded-full"></div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="w-full">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-xs font-bold text-white uppercase tracking-wider mb-2">
                    Email Address
                </label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-purple-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full bg-[#f0f4ff] border-2 border-transparent focus:border-[#ffcc00] focus:ring-0 rounded-2xl py-3.5 pl-12 pr-4 text-gray-900 font-semibold placeholder-gray-400 shadow-inner text-sm transition duration-150"
                        placeholder="example@email.com">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-300 text-xs" />
            </div>

            <div class="mb-5">
                <label for="password" class="block text-xs font-bold text-white uppercase tracking-wider mb-2">
                    Password
                </label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-purple-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full bg-[#f0f4ff] border-2 border-transparent focus:border-[#ffcc00] focus:ring-0 rounded-2xl py-3.5 pl-12 pr-4 text-gray-900 font-semibold placeholder-gray-400 shadow-inner text-sm transition duration-150"
                        placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-300 text-xs" />
            </div>

            <div class="flex items-center justify-between mb-8 text-xs">
                <label for="remember_me" class="inline-flex items-center text-purple-200 cursor-pointer select-none">
                    <input id="remember_me" type="checkbox" name="remember" 
                        class="rounded border-purple-400 bg-[#7138b8] text-[#ffcc00] focus:ring-[#ffcc00] h-4 w-4 transition duration-150">
                    <span class="ms-2 font-medium">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-purple-200 hover:text-white hover:underline font-medium transition duration-150">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-[#ffdf00] to-[#ff8c00] hover:from-[#ffe53b] hover:to-[#ff9914] text-gray-900 font-black py-4 rounded-2xl shadow-lg transition duration-150 tracking-wider text-sm mb-6 uppercase transform active:scale-[0.98]">
                SIGN IN
            </button>

            <p class="text-center text-sm text-purple-200">
                Don't have an account? <a href="{{ route('register') }}" class="text-[#ffcc00] font-bold hover:underline ml-1">Register Now</a>
            </p>
        </form>
    </div>
</x-guest-layout>