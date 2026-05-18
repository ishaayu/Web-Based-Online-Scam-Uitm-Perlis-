<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2e1065] via-[#4c1d95] to-[#7c3aed] p-6">
        <div class="w-full max-w-md bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 shadow-2xl">
            
            <div class="flex flex-col items-center mb-6">
                        <x-application-logo />
                        <h2 class="text-3xl font-bold text-white tracking-tight mt-4">
                     UiTM<span class="text-yellow-400">Guard</span>
                </h2>
                 <div class="h-1 w-12 bg-yellow-400 rounded-full mt-2"></div>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-purple-100 text-xs font-bold uppercase mb-2 ml-1">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-purple-300"></i>
                        <input type="email" name="email" required autofocus class="w-full bg-white/5 border border-purple-400/30 rounded-2xl py-4 pl-12 pr-4 text-white placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:bg-white/10 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-purple-100 text-xs font-bold uppercase mb-2 ml-1">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-purple-300"></i>
                        <input type="password" name="password" required class="w-full bg-white/5 border border-purple-400/30 rounded-2xl py-4 pl-12 pr-4 text-white placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:bg-white/10 transition-all">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-purple-200">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-purple-400 text-purple-600 focus:ring-purple-500">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="hover:text-yellow-400 transition-colors">Forgot password?</a>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-yellow-400 to-orange-500 text-purple-900 font-bold py-4 rounded-2xl shadow-lg transform hover:scale-[1.02] active:scale-95 transition-all">
                    SIGN IN
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-purple-200 text-sm">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-yellow-400 font-bold hover:underline">Register Now</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>