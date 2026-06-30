<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | UiTMGuard</title>
    @include('partials.head-assets')
</head>
<body class="bg-gray-100 flex flex-col md:flex-row min-h-screen font-sans antialiased">

    <header class="md:hidden bg-gray-900 text-white px-4 py-3 flex justify-between items-center shadow-md sticky top-0 z-30">
        <span class="font-bold text-sm tracking-wide">ADMIN<span class="text-purple-500">PANEL</span></span>
        <div class="flex items-center gap-3 text-xs font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="text-purple-300">Dashboard</a>
            <a href="{{ route('admin.summary') }}" class="text-gray-400">Summary</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-400">Logout</button>
            </form>
        </div>
    </header>

    <aside class="hidden md:flex w-64 bg-gray-900 text-white flex-col shadow-2xl shrink-0 z-10">
        <div class="h-20 flex items-center justify-center border-b border-gray-800">
            <span class="font-bold text-xl tracking-wide">ADMIN<span class="text-purple-500">PANEL</span></span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3 bg-purple-700 rounded-lg text-white shadow-md transition hover:bg-purple-600">
                <i class="fas fa-tachometer-alt w-5"></i> Dashboard Overview
            </a>
            
            <a href="{{ route('admin.summary') }}" class="flex items-center gap-4 px-4 py-3 text-gray-400 hover:bg-gray-800 rounded-lg hover:text-white transition">
                <i class="fas fa-chart-pie w-5"></i> Summary Report
            </a>
        </nav>
        <div class="p-4 border-t border-gray-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf 
                <button type="submit" class="text-gray-400 hover:text-white text-sm flex items-center gap-2 w-full transition cursor-pointer p-2 rounded hover:bg-gray-800">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto w-full p-4 md:p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Admin Overview</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Total Students</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
                <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Pending Cases</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $pendingReports }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-emerald-500">
                <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Resolved Cases</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $resolvedReports }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold rounded-xl flex items-center gap-2 shadow-sm animate-fade-in">
                <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-chart-bar text-purple-700 text-lg"></i>
                <h3 class="text-lg font-bold text-gray-800">Monthly Incident Breakdown ({{ date('Y') }})</h3>
            </div>
            <div class="relative w-full h-72 md:h-80">
                <canvas id="incidentTrendChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50 font-bold text-gray-700">All Student Reports</div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead class="bg-gray-100 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="p-4 pl-6">Student Info</th>
                            <th class="p-4">Incident Type</th>
                            <th class="p-4">Evidence Document</th>
                            <th class="p-4">Status Field</th>
                            <th class="p-4 pr-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                        @if($reports->isEmpty())
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400">No reports have been submitted yet.</td>
                            </tr>
                        @else
                            @foreach($reports as $report)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="p-4 pl-6">
                                    <p class="font-bold text-gray-800 leading-tight">{{ $report->user->name }}</p>
                                    <p class="text-xs text-gray-400 font-mono mt-0.5">{{ $report->user->email }}</p>
                                </td>
                                <td class="p-4 text-gray-600 font-semibold">{{ $report->scam_type }}</td>
                                <td class="p-4">
                                    @if($report->evidence)
                                        <a href="{{ asset('storage/'.$report->evidence) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-bold inline-flex items-center gap-1 underline decoration-2">
                                            <i class="fas fa-image"></i> View Img
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic font-normal">None Provided</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($report->status == 'Pending')
                                        <span class="bg-amber-50 text-amber-700 border border-amber-200 px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider">Pending</span>
                                    @else
                                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider">Resolved</span>
                                    @endif
                                </td>
                                <td class="p-4 pr-6">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('report.summary', $report->id) }}" target="_blank" class="bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-200 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm transition flex items-center gap-1.5">
                                            <i class="fas fa-file-invoice"></i> Summary Report
                                        </a>

                                        @if($report->status == 'Pending')
                                            <form action="{{ route('admin.resolve', $report->id) }}" method="POST" class="inline">
                                                @csrf 
                                                @method('PATCH')
                                                <button type="submit" class="bg-emerald-600 text-white px-3 py-1.5 rounded-lg hover:bg-emerald-700 text-xs font-bold shadow-sm transition flex items-center gap-1.5 cursor-pointer">
                                                    <i class="fas fa-check"></i> Solve Case
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.delete', $report->id) }}" method="POST" onsubmit="return confirm('Permanently delete this report?');" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 p-1.5 rounded-lg hover:bg-red-100 transition cursor-pointer" title="Delete Log Entry">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="chat-widget" class="fixed bottom-6 right-6 z-50">
        <button onclick="toggleChat()" class="bg-purple-700 hover:bg-purple-800 text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition-all transform hover:scale-110 cursor-pointer">
            <i class="fas fa-robot text-2xl"></i>
        </button>

        <div id="chat-box" class="hidden absolute bottom-16 right-0 w-80 bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">
            <div class="bg-purple-800 p-4 text-white flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <i class="fas fa-shield-alt"></i>
                    <span class="font-bold">UiTMGuard Bot</span>
                </div>
                <button onclick="toggleChat()" class="text-purple-200 hover:text-white text-xl font-bold cursor-pointer">&times;</button>
            </div>
            
            <div id="chat-messages" class="h-64 overflow-y-auto p-4 bg-gray-50 space-y-3 text-sm">
                <div class="bg-purple-100 text-purple-900 p-3 rounded-tr-xl rounded-bl-xl rounded-br-xl w-3/4">
                    Hello! I am the automated support bot. How can I help you?
                </div>
                <div class="flex gap-2 flex-wrap mt-2">
                    <button onclick="askBot('report')" class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs hover:bg-purple-50 cursor-pointer">How to report?</button>
                    <button onclick="askBot('status')" class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs hover:bg-purple-50 cursor-pointer">Check Status</button>
                    <button onclick="askBot('emergency')" class="bg-white border border-red-200 text-red-600 px-3 py-1 rounded-full text-xs hover:bg-red-50 cursor-pointer">Urgent Help</button>
                </div>
            </div>

            <div class="p-3 border-t bg-white flex gap-2">
                <input type="text" id="chat-input" placeholder="Type a message..." class="w-full text-sm outline-none bg-transparent">
                <button onclick="sendMessage()" class="text-purple-700 font-bold cursor-pointer"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- LOGIK GRAF BAR BERLAPIS (STACKED SCAM TYPE) ---
        document.addEventListener("DOMContentLoaded", function () {
            const matrixDatasets = <?php echo json_encode($scamDatasets ?? []); ?>;
            const ctx = document.getElementById('incidentTrendChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: matrixDatasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: { font: { family: 'Outfit', weight: 'bold' } }
                        },
                        tooltip: {
                            mode: 'index', 
                            intersect: false,
                            bodyFont: { family: 'Outfit' },
                            titleFont: { family: 'Outfit', weight: 'bold' }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            ticks: { font: { family: 'Outfit' } },
                            grid: { display: false }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: { family: 'Outfit' }
                            },
                            grid: { color: 'rgba(0, 0, 0, 0.04)' }
                        }
                    }
                }
            });
        }); // <-- Tadi tertinggal kurungan ini yang menyebabkan ralat sistem

        // --- LOGIK WIDGET CHAT BOT ---
        function toggleChat() {
            const box = document.getElementById('chat-box');
            box.classList.toggle('hidden');
        }

        function handleEnter(e) {
            if (e.key === 'Enter') sendMessage();
        }

        document.getElementById('chat-input').addEventListener('keypress', handleEnter);

        function sendMessage() {
            const input = document.getElementById('chat-input');
            const msg = input.value.trim();
            if (!msg) return;

            addMessage(msg, 'user');
            input.value = '';

            setTimeout(() => {
                let reply = "I'm not sure about that. Please contact admin@uitm.edu.my.";
                const lowerMsg = msg.toLowerCase();

                if (lowerMsg.includes('hello') || lowerMsg.includes('hi')) reply = "Hi there! How can I assist you with UiTMGuard today?";
                else if (lowerMsg.includes('report') || lowerMsg.includes('scam')) reply = "To report a scam, click 'New Complaint' in the sidebar and fill out the form.";
                else if (lowerMsg.includes('status') || lowerMsg.includes('check')) reply = "You can check your report status in the 'My Reports' tab.";
                else if (lowerMsg.includes('delete') || lowerMsg.includes('remove')) reply = "Only Admins can delete reports completely. You can edit pending reports.";
                
                addMessage(reply, 'bot');
            }, 600);
        }

        function askBot(type) {
            if (type === 'report') addMessage("How do I report a scam?", 'user');
            if (type === 'status') addMessage("How do I check my status?", 'user');
            if (type === 'emergency') addMessage("This is an emergency!", 'user');
            
            setTimeout(() => {
                if (type === 'report') addMessage("Click 'New Complaint' on the left menu. Fill in the details and upload a screenshot.", 'bot');
                if (type === 'status') addMessage("Go to 'My Reports'. If it says 'Pending', we are reviewing it. If 'Resolved', action has been taken.", 'bot');
                if (type === 'emergency') addMessage("For urgent financial fraud, please call the UiTM Auxiliary Police or your Bank immediately.", 'bot');
            }, 600);
        }

        function addMessage(text, sender) {
            const div = document.createElement('div');
            const classes = sender === 'user' 
                ? ['bg-purple-600', 'text-white', 'p-3', 'rounded-tl-xl', 'rounded-bl-xl', 'rounded-br-xl', 'ml-auto', 'w-fit', 'max-w-[80%]'] 
                : ['bg-purple-100', 'text-purple-900', 'p-3', 'rounded-tr-xl', 'rounded-bl-xl', 'rounded-br-xl', 'w-fit', 'max-w-[80%]'];
            
            div.classList.add(...classes);
            div.innerText = text;
            document.getElementById('chat-messages').appendChild(div);
            
            const container = document.getElementById('chat-messages');
            container.scrollTop = container.scrollHeight;
        }
    </script>
</body>
</html>