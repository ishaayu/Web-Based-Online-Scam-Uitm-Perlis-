<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to UiTMGuard | Secure Campus Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-purple-900 p-2 rounded-lg">
                    <i class="fas fa-shield-alt text-yellow-400 text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-purple-900 tracking-tight">UiTM<span class="text-yellow-600">Guard</span></span>
            </div>
            
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-purple-900 font-semibold hover:text-purple-700">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-purple-900 font-bold hover:bg-purple-50 rounded-xl transition-all">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-purple-900 text-white font-bold rounded-xl shadow-lg shadow-purple-200 hover:bg-purple-800 transition-all">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="relative bg-purple-900 py-24 overflow-hidden">
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-yellow-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-purple-400/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block px-4 py-1.5 bg-yellow-400 text-purple-900 rounded-full text-xs font-bold uppercase tracking-widest mb-6">Campus Security First</span>
                <h1 class="text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Reporting Scams <br> <span class="text-yellow-400">Made Simple.</span>
                </h1>
                <p class="text-purple-100 text-lg mb-10 max-w-lg leading-relaxed">
                    UiTMGuard is a dedicated platform for students to report suspicious activities, phishing, and scams within the campus community. Stay safe, stay guarded.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-yellow-400 text-purple-900 font-bold rounded-2xl shadow-xl hover:bg-yellow-300 transition-all flex items-center gap-3">
                        Get Started <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="absolute inset-0 bg-yellow-400 rounded-3xl rotate-3"></div>
                    <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=800" alt="Security" class="relative rounded-3xl shadow-2xl grayscale hover:grayscale-0 transition-all duration-700">
                </div>
            </div>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 -mt-16 relative z-20">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex items-center gap-6">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 text-2xl">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">100%</h3>
                    <p class="text-gray-500 text-sm">Secure Reporting</p>
                </div>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex items-center gap-6">
                <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center text-yellow-600 text-2xl">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Fast</h3>
                    <p class="text-gray-500 text-sm">Admin Response</p>
                </div>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex items-center gap-6">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 text-2xl">
                    <i class="fas fa-university"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Official</h3>
                    <p class="text-gray-500 text-sm">UiTM Managed</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-purple-900">How It Works</h2>
            <div class="w-20 h-1.5 bg-yellow-400 mx-auto mt-4 rounded-full"></div>
        </div>
        
        <div class="grid md:grid-cols-3 gap-12">
            <div class="text-center group">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-900 group-hover:text-white transition-all">
                    <span class="text-2xl font-bold">1</span>
                </div>
                <h4 class="font-bold text-xl mb-3">Register</h4>
                <p class="text-gray-600">Create an account using your official UiTM student email.</p>
            </div>
            <div class="text-center group">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-900 group-hover:text-white transition-all">
                    <span class="text-2xl font-bold">2</span>
                </div>
                <h4 class="font-bold text-xl mb-3">Report Scam</h4>
                <p class="text-gray-600">Provide details and upload evidence of the suspicious activity.</p>
            </div>
            <div class="text-center group">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-900 group-hover:text-white transition-all">
                    <span class="text-2xl font-bold">3</span>
                </div>
                <h4 class="font-bold text-xl mb-3">Stay Updated</h4>
                <p class="text-gray-600">Receive email notifications once our admins resolve the case.</p>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="bg-gray-200 p-1.5 rounded">
                    <i class="fas fa-shield-alt text-gray-600"></i>
                </div>
                <span class="font-bold text-gray-500">UiTMGuard</span>
            </div>
            <p class="text-gray-400 text-sm">© 2026 Universiti Teknologi MARA. Cyber Security Project.</p>
        </div>
    </footer>

</body>
</html>