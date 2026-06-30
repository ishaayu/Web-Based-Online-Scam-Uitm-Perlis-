<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UiTM Auxiliary Police - Scam Reporting Portal</title>
    @include('partials.head-assets')
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
</head>
<body class="bg-slate-50 font-sans antialiased selection:bg-amber-500 selection:text-white">

    <div class="bg-amber-500 text-slate-900 text-center py-2 text-xs font-bold tracking-wider uppercase">
        Official Campus Security Initiative &bull; UiTM Cawangan Perlis
    </div>

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 sm:h-20 flex flex-col sm:flex-row justify-between items-center gap-4">
            
            <a href="/" class="flex items-center space-x-3 group">
                <div class="bg-purple-950 text-amber-400 p-2 rounded-xl shadow-inner font-black text-xl tracking-tight transition-transform group-hover:scale-105">
                    PB
                </div>
                <div>
                    <span class="text-lg font-extrabold text-purple-950 tracking-tight block leading-none">POLIS BANTUAN</span>
                    <span class="text-xs font-semibold text-slate-400 tracking-wider uppercase">UiTM Perlis</span>
                </div>
            </a>
            
            <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-6 w-full sm:w-auto">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-purple-950 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-purple-950 hover:bg-purple-900 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center w-full sm:w-auto">
                        Register Account
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-purple-950 transition">
                        Dashboard
                    </a>
                    <a href="{{ route('report.index') }}" class="text-sm font-semibold text-slate-600 hover:text-purple-950 transition">
                        My Reports
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800 transition cursor-pointer w-full sm:w-auto">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <header class="relative bg-gradient-to-br from-purple-950 via-purple-900 to-indigo-950 text-white overflow-hidden py-16 lg:py-24">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-amber-500/10 via-transparent to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            <div class="lg:col-span-7 space-y-6">
                <span class="inline-flex items-center gap-1.5 bg-amber-400/10 border border-amber-400/20 text-amber-400 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span> Campus Security First
                </span>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-tight">
                    Reporting Scams <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-300">Made Simple.</span>
                </h1>
                
                <p class="text-slate-300 text-base sm:text-lg max-w-xl leading-relaxed">
                    The Auxiliary Police Scam Support Portal is a dedicated environment for students to report cyber fraud, phishing tactics, and suspicious financial activities safely within our campus network.
                </p>
                
                <div class="pt-2 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('report.create') }}" class="bg-amber-400 hover:bg-amber-300 text-purple-950 font-bold px-8 py-4 rounded-xl shadow-lg shadow-amber-500/10 flex items-center justify-center gap-2 group transition-all duration-200">
                        File a Report 
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 to-purple-600 rounded-2xl blur-xl opacity-30 animate-pulse"></div>
                <div class="relative bg-slate-900 border border-white/10 rounded-2xl overflow-hidden shadow-2xl aspect-video lg:aspect-square flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80" alt="Security Grid Interface" class="object-cover w-full h-full mix-blend-luminosity opacity-40">
                    <div class="absolute inset-0 bg-gradient-to-t from-purple-950 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 p-4 bg-white/5 backdrop-blur-md rounded-xl border border-white/10">
                        <p class="text-xs text-amber-400 font-bold tracking-wider uppercase mb-1">Live Tracking</p>
                        <p class="text-sm font-medium text-slate-200">Securing over 10,000+ active students across campus grounds.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 -mt-10 relative z-20 mb-12">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 flex flex-col md:flex-row items-center justify-around divide-y md:divide-y-0 md:divide-x divide-slate-100">
            <div class="text-center p-4 w-full">
                <div class="flex items-center justify-center gap-2 mb-1">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <p class="text-4xl font-black text-purple-950">{{ $resolvedCases ?? 0 }}</p>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Cases Resolved</p>
            </div>
            
            <div class="text-center p-4 w-full">
                <p class="text-4xl font-black text-amber-500 mb-1">{{ $actionRate ?? 100 }}%</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Action Rate</p>
            </div>
            
            <div class="text-center p-4 w-full">
                <p class="text-4xl font-black text-purple-950 mb-1">24/7</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Active Monitoring</p>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-6 pb-12">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-black text-slate-800">Live Campus Scam Trends</h2>
                <p class="text-sm text-slate-500 mt-1">Real-time data visualization based on active student reports.</p>
            </div>
            <div class="relative h-80 w-full flex justify-center">
                <canvas id="publicScamBarChart"></canvas>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition duration-300 group">
                <div class="w-12 h-12 bg-purple-50 text-purple-900 rounded-xl flex items-center justify-center mb-5 group-hover:bg-purple-900 group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.24-8.73-3.41z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">100% Secure & Private</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Your Identity and private case data are fully encrypted and only visible to authorized case investigators.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition duration-300 group">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-amber-500 group-hover:text-slate-900 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Rapid Officer Assignment</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Reports are directly queued into the Auxiliary Police database dispatching immediately to active officers.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition duration-300 group">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.33l-7.5-5-7.5 5V21m16.5 0H3.75"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Official UiTM Governance</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Operated officially under the jurisdiction of UiTM Cawangan Perlis, Kampus Arau management structures.</p>
            </div>

        </div>
    </section>

    <script>
        const scamDataFromServer = <?php echo json_encode($scamStats ?? []); ?>;
        
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('publicScamBarChart').getContext('2d');
            const scamData = scamDataFromServer;
            
            const labels = Object.keys(scamData).length > 0 ? Object.keys(scamData) : ['Awaiting Data'];
            const data = Object.values(scamData).length > 0 ? Object.values(scamData) : [0];

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Reports',
                        data: data,
                        backgroundColor: '#f59e0b', // Amber-500 color matching theme
                        borderRadius: 6,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            ticks: { precision: 0, color: '#94a3b8' },
                            grid: { color: '#f1f5f9' }
                        },
                        x: { 
                            ticks: { color: '#64748b', font: { weight: 'bold' } },
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>