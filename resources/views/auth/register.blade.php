<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2e1065] via-[#4c1d95] to-[#7c3aed] p-6">
        <div class="w-full max-w-lg bg-white/10 backdrop-blur-lg rounded-3xl p-10 border border-white/20 shadow-2xl relative overflow-hidden">
            
            <div class="absolute -top-6 -right-6 w-32 h-32 bg-yellow-400/10 rounded-full flex items-center justify-center blur-2xl"></div>

            <div class="text-center mb-10">
                <i class="fas fa-user-shield text-5xl text-yellow-400 mb-4"></i>
                <h2 class="text-3xl font-bold text-white">Create Account</h2>
                <p class="text-purple-200">Join the UiTMGuard community</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <input type="text" name="name" placeholder="Full Name" required class="w-full bg-white/5 border border-purple-400/30 rounded-xl py-4 px-6 text-white placeholder-purple-300 focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="UiTM Email Address" required class="w-full bg-white/5 border border-purple-400/30 rounded-xl py-4 px-6 text-white placeholder-purple-300 focus:ring-2 focus:ring-yellow-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <input type="password" name="password" placeholder="Password" required class="w-full bg-white/5 border border-purple-400/30 rounded-xl py-4 px-6 text-white placeholder-purple-300 focus:ring-2 focus:ring-yellow-400">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full bg-white/5 border border-purple-400/30 rounded-xl py-4 px-6 text-white placeholder-purple-300 focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-yellow-400 text-purple-900 font-bold py-4 rounded-xl shadow-xl hover:bg-yellow-300 transition-all uppercase tracking-widest">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-purple-200">
                Already registered? <a href="{{ route('login') }}" class="text-yellow-400 font-bold hover:underline">Log in here</a>
            </div>
        </div>
    </div>
</x-guest-layout>