<x-guest-layout>
    <div class="bg-[#5c20a6] shadow-2xl rounded-2xl p-8 flex flex-col items-center border border-purple-500/30">
        
        <div class="flex flex-col items-center mb-6 w-full">
            <img src="{{ asset('images/logo_polis_bantuan.jpg') }}" alt="Polis Bantuan UiTM" class="h-28 mb-4 object-contain drop-shadow-md">
            
            <h2 class="text-[1.1rem] font-medium text-white text-center tracking-wide">Join the Auxiliary Police community</h2>
            
            <div class="text-[#ffcc00] mt-3">
                <i class="fa-solid fa-user-shield text-3xl drop-shadow"></i>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}" class="w-full">
            @csrf

            <div class="border border-purple-400/40 rounded-xl overflow-hidden mb-6 shadow-inner">
                
                <div class="relative bg-[#7138b8]/80 border-b border-purple-400/30">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="block w-full border-0 px-5 py-4 bg-transparent focus:ring-2 focus:ring-[#ffcc00] focus:outline-none text-white placeholder-purple-200/70 text-sm"
                        placeholder="Full Name">
                </div>
                
                <div class="relative bg-[#7138b8]/60 border-b border-purple-400/30">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="block w-full border-0 px-5 py-4 bg-transparent focus:ring-2 focus:ring-[#ffcc00] focus:outline-none text-white placeholder-purple-200/50 text-sm"
                        placeholder="email">
                </div>
                
                <div class="relative bg-[#7138b8]/60 border-b border-purple-400/30">
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block w-full border-0 px-5 py-4 bg-transparent focus:ring-2 focus:ring-[#ffcc00] focus:outline-none text-white placeholder-purple-200/50 text-sm tracking-widest font-bold"
                        placeholder="Password">
                </div>
                
                <div class="relative bg-[#7138b8]/80">
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="block w-full border-0 px-5 py-4 bg-transparent focus:ring-2 focus:ring-[#ffcc00] focus:outline-none text-white placeholder-purple-200/70 text-sm"
                        placeholder="Confirm Password">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full bg-[#ffcc00] hover:bg-yellow-400 text-[#5c20a6] font-black py-3 px-4 rounded-xl shadow-md transition-all duration-200 uppercase tracking-wider text-sm cursor-pointer">
                    Register Account
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm text-purple-200">
            Already registered? <a href="{{ route('login') }}" class="text-[#ffcc00] font-bold hover:underline">Log in here</a>
        </div>
        
    </div>
</x-guest-layout>