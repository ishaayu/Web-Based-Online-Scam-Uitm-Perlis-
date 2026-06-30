<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UiTM Guard') }}</title>

    @include('partials.head-assets')
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">

    <header class="md:hidden bg-[#4a157d] text-white px-6 py-4 flex justify-between items-center shadow-md sticky top-0 z-30">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo_polis_bantuan.jpg') }}" alt="Logo" class="h-8 w-8 object-contain rounded-md bg-white p-0.5">
            <span class="text-sm font-extrabold tracking-tight">POLIS BANTUAN</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="text-xs font-bold text-red-300 hover:text-red-100 transition cursor-pointer">Logout</button>
        </form>
    </header>

    <div class="flex flex-col md:flex-row min-h-screen w-full">
        
        <aside class="hidden md:flex w-64 bg-[#4a157d] flex-col justify-between p-5 text-white shadow-xl shrink-0 z-20">
            
            <div>
                <div class="flex items-center gap-3 mb-8 px-2 py-4 border-b border-purple-500/40">
                    <div class="flex-shrink-0 bg-white p-1.5 rounded-xl shadow-sm w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('images/logo_polis_bantuan.jpg') }}" 
                             alt="Logo Polis Bantuan" 
                             class="max-h-full max-w-full object-contain">
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-extrabold text-[13px] tracking-wider uppercase leading-tight text-white">Polis Bantuan</span>
                        <span class="text-[10px] text-[#ffcc00] font-bold tracking-widest uppercase mt-0.5">UiTM Perlis</span>
                    </div>
                </div>

                <nav class="space-y-1.5 flex flex-col">
                    <a href="#" class="flex items-center gap-3 bg-gradient-to-r from-[#ffcc00]/20 to-transparent border-l-4 border-[#ffcc00] px-4 py-3.5 rounded-r-xl text-white font-bold text-sm transition duration-150">
                        <i class="fa-solid fa-table-columns text-[#ffcc00] w-5 text-center"></i>
                        Dashboard Overview
                    </a>

                    <a href="#" class="flex items-center gap-3 text-purple-200 hover:text-white hover:bg-white/10 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 border-l-4 border-transparent">
                        <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i>
                        My Case History
                    </a>

                    <a href="#" class="flex items-center gap-3 text-purple-200 hover:text-white hover:bg-white/10 px-4 py-3.5 rounded-xl text-sm font-medium transition duration-150 border-l-4 border-transparent">
                        <i class="fa-solid fa-circle-plus w-5 text-center"></i>
                        New Report
                    </a>
                </nav>
            </div>

            <div class="border-t border-purple-500/40 pt-5 px-2 mt-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="h-10 w-10 bg-[#ffcc00] rounded-full flex items-center justify-center text-[#4a157d] font-black text-sm uppercase shadow-inner shrink-0">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex flex-col overflow-hidden">
                        <span class="text-sm font-bold text-white leading-tight truncate capitalize">{{ Auth::user()->name ?? 'User' }}</span>
                        <span class="text-[10px] text-purple-300 font-semibold tracking-wider">Active Session</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full bg-black/20 hover:bg-red-500/90 text-purple-100 hover:text-white text-xs font-bold py-2.5 px-4 rounded-xl transition-all duration-200 text-center tracking-wider uppercase flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 w-full p-6 md:p-10 min-w-0 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</body>
</html>