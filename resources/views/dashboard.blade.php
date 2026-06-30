<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Polis Bantuan UiTM</title>
    @include('partials.head-assets')
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
</head>
<body class="bg-slate-50 flex flex-col md:flex-row min-h-screen font-sans antialiased">

    <header class="md:hidden bg-purple-950 text-white px-6 py-4 flex justify-between items-center border-b border-purple-900 shadow-md z-30">
        <div class="flex items-center gap-2">
            <div class="bg-amber-400 text-purple-950 font-black px-2 py-1 rounded-lg text-sm">PB</div>
            <span class="text-sm font-extrabold tracking-tight">POLIS BANTUAN</span>
        </div>
        <div class="flex items-center gap-4 text-xs font-semibold">
            <a href="{{ route('report.index') }}" class="text-purple-200 hover:text-amber-400">History</a>
            <a href="{{ route('report.create') }}" class="bg-amber-400 text-purple-950 px-3 py-1.5 rounded-lg font-bold">New Report</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-red-400">Logout</button>
            </form>
        </div>
    </header>

    <aside class="w-64 bg-purple-950 text-white flex-col hidden md:flex justify-between shadow-xl z-20 min-h-screen">
        <div class="p-6 flex items-center gap-3 border-b border-purple-900/50">
            <div class="bg-amber-400 text-purple-950 font-black p-2 rounded-xl shadow-inner text-lg tracking-tight">PB</div>
            <div>
                <span class="text-lg font-extrabold tracking-tight block leading-none">POLIS BANTUAN</span>
                <span class="text-xs font-semibold text-purple-300 tracking-wider uppercase">UiTM Perlis</span>
            </div>
        </div>
        
        <nav class="flex-1 p-4 space-y-2 text-sm font-medium">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 bg-purple-900/60 text-amber-400 px-4 py-3 rounded-xl border border-purple-800/50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                Dashboard Overview
            </a>
            <a href="{{ route('report.index') }}" class="flex items-center gap-3 hover:bg-purple-900/40 px-4 py-3 rounded-xl transition text-purple-200 hover:text-white group">
                <svg class="w-5 h-5 text-purple-400 group-hover:text-purple-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                My Case History
            </a>
            <a href="{{ route('report.create') }}" class="flex items-center gap-3 hover:bg-purple-900/40 px-4 py-3 rounded-xl transition text-purple-200 hover:text-white group">
                <svg class="w-5 h-5 text-purple-400 group-hover:text-purple-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                New Report
            </a>
        </nav>
        
        <div class="p-4 border-t border-purple-900/50 bg-purple-950">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-amber-400 text-purple-950 flex items-center justify-center font-bold uppercase shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="text-sm font-medium truncate text-purple-100">{{ Auth::user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-center font-semibold bg-red-500/10 hover:bg-red-500/20 px-4 py-2.5 rounded-xl text-sm text-red-400 hover:text-red-300 transition cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-4 md:p-8 relative w-full">
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-900/5 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <header class="mb-8 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Welcome, {{ explode(' ', Auth::user()->name)[0] }}</h1>
                <p class="text-slate-500 text-sm">Monitor your security reports and campus analytics below.</p>
            </div>

            <div class="relative group cursor-pointer z-50">
                <div class="bg-white p-3 rounded-full shadow-sm border border-slate-200 relative">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    @if(Auth::user()->unreadNotifications->count() > 0)
                        <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                    @endif
                </div>

                <div class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-100 p-4 hidden group-hover:block">
                    <div class="flex justify-between items-center mb-3 border-b pb-2">
                        <span class="font-bold text-slate-700 text-sm">Notifications</span>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.read') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-purple-600 hover:underline">Mark all as read</button>
                            </form>
                        @endif
                    </div>
                    
                    <div class="space-y-3 max-h-60 overflow-y-auto">
                        @forelse(Auth::user()->unreadNotifications as $notification)
                            <div class="bg-purple-50 p-3 rounded-lg border border-purple-100">
                                <p class="text-xs text-slate-700 font-medium">{{ $notification->data['message'] }}</p>
                                <a href="{{ url('/admin-summary/report/' . $notification->data['report_id']) }}" target="_blank" class="text-xs font-bold text-purple-700 mt-2 inline-block hover:underline">View Summary Report &rarr;</a>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 text-center py-4">No new notifications.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between border-l-4 border-l-amber-500 relative overflow-hidden group hover:shadow-md transition">
                <div class="relative z-10">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Active / Pending Investigations</p>
                    <h2 class="text-4xl font-black text-slate-800 tracking-tight">{{ $totalPending }}</h2>
                </div>
                <div class="bg-amber-50 p-4 rounded-2xl text-amber-500 relative z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between border-l-4 border-l-green-500 relative overflow-hidden group hover:shadow-md transition">
                <div class="relative z-10">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Cases Resolved & Closed</p>
                    <h2 class="text-4xl font-black text-slate-800 tracking-tight">{{ $totalResolved }}</h2>
                </div>
                <div class="bg-green-50 p-4 rounded-2xl text-green-500 relative z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Your Report Analytics</h3>
                    <p class="text-xs text-slate-400 mb-4">Breakdown of the scam categories you have reported.</p>
                </div>
                <div class="relative h-64 w-full flex justify-center items-center">
                    <canvas id="scamRingChart"></canvas>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-950 to-indigo-950 p-8 rounded-2xl shadow-lg text-white relative overflow-hidden flex flex-col justify-between">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-amber-400/20 rounded-full blur-2xl pointer-events-none"></div>
                
                <div>
                    <h3 class="text-xl font-black text-amber-400 mb-2 tracking-tight">Campus Scam Directory</h3>
                    <p class="text-sm text-purple-200 mb-6 leading-relaxed">Cross-check suspicious phone numbers, bank accounts, or links against our campus database before proceeding with transactions.</p>
                </div>
                
                <form action="#" method="GET" class="space-y-4 relative z-10">
                    <div>
                        <select class="w-full px-4 py-3 rounded-xl bg-purple-900/50 border border-purple-700/50 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 backdrop-blur-sm">
                            <option>Check Phone Number</option>
                            <option>Check Bank Account No.</option>
                            <option>Check Website / Link URL</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" placeholder="e.g. 0123456789" class="w-full px-4 py-3 rounded-xl bg-white text-slate-900 text-sm focus:outline-none border-0 shadow-inner">
                        <button type="button" onclick="alert('This number is not flagged in the Auxiliary Police database. However, please remain vigilant.')" class="bg-amber-400 hover:bg-amber-300 text-purple-950 font-bold px-6 py-3 rounded-xl transition shadow-md whitespace-nowrap cursor-pointer">
                            Verify
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('scamRingChart').getContext('2d');
            const scamData = <?php echo json_encode($scamStats ?? []); ?>;
            
            const labels = Object.keys(scamData).length > 0 ? Object.keys(scamData) : ['No Reports Filed Yet'];
            const data = Object.values(scamData).length > 0 ? Object.values(scamData) : [1];
            const colors = Object.keys(scamData).length > 0 
                ? ['#f59e0b', '#3b82f6', '#8b5cf6', '#ef4444', '#10b981'] 
                : ['#e2e8f0'];

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors,
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { 
                            position: 'bottom', 
                            labels: { 
                                usePointStyle: true, 
                                padding: 20, 
                                font: { family: 'ui-sans-serif, system-ui, sans-serif', size: 11 } 
                            } 
                        },
                        tooltip: { enabled: Object.keys(scamData).length > 0 }
                    }
                }
            });
        });
    </script>
</body>
</html>