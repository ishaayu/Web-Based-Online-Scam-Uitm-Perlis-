<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard | UiTMGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <aside class="w-72 bg-[#2e1065] text-white flex flex-col shadow-2xl z-20">
        <div class="h-24 flex items-center justify-center border-b border-purple-900/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-shield-alt text-purple-900 text-xl"></i>
                </div>
                <span class="font-bold text-2xl tracking-wide">UiTM<span class="text-yellow-400">Guard</span></span>
            </div>
        </div>
        <nav class="flex-1 px-4 py-8 space-y-3">
            <p class="px-4 text-xs font-semibold text-purple-400 uppercase tracking-wider mb-2">Main Menu</p>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-4 bg-purple-800/50 rounded-xl text-white shadow-inner border border-purple-700/50"><i class="fas fa-chart-pie w-6"></i> <span class="font-medium">Dashboard</span></a>
            <a href="{{ route('report.index') }}" class="flex items-center gap-4 px-4 py-4 text-purple-200 hover:bg-white/10 hover:text-white rounded-xl transition-all"><i class="fas fa-folder-open w-6"></i> <span class="font-medium">My Reports</span></a>
            <a href="{{ route('report.create') }}" class="flex items-center gap-4 px-4 py-4 text-purple-200 hover:bg-white/10 hover:text-white rounded-xl transition-all"><i class="fas fa-plus-circle w-6"></i> <span class="font-medium">New Report</span></a>
        </nav>
        <div class="p-6 border-t border-purple-900/50 bg-[#240a55]">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-400 flex items-center justify-center text-purple-900 font-bold text-xl">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="overflow-hidden">
                    <p class="font-bold text-white text-sm truncate w-24">{{ Auth::user()->name }}</p>
                    <form action="{{ route('logout') }}" method="POST">@csrf <button class="text-xs text-purple-300 hover:text-yellow-400">Sign Out</button></form>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">
        <div class="w-full bg-gradient-to-r from-[#4c1d95] to-[#7c3aed] rounded-3xl p-10 text-white shadow-xl mb-10 relative overflow-hidden">
            <h1 class="text-3xl font-bold mb-2 z-10 relative">Welcome Back, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-purple-100 z-10 relative">Here is your security overview.</p>
            <div class="absolute right-0 top-0 h-64 w-64 bg-white/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-800 text-xl mb-6"><i class="fas fa-chart-area text-purple-600 mr-2"></i>Analytics</h3>
                <div class="h-64 flex justify-center"><canvas id="reportsChart"></canvas></div>
            </div>
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border-l-8 border-yellow-400 flex justify-between items-center">
                    <div><p class="text-gray-500 text-xs font-bold uppercase">Pending</p><p class="text-4xl font-bold text-gray-800">{{ $totalPending }}</p></div>
                    <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center"><i class="fas fa-clock"></i></div>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border-l-8 border-green-500 flex justify-between items-center">
                    <div><p class="text-gray-500 text-xs font-bold uppercase">Resolved</p><p class="text-4xl font-bold text-gray-800">{{ $totalSolved }}</p></div>
                    <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center"><i class="fas fa-check"></i></div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('reportsChart');
        if(ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Resolved', 'Other'],
                    datasets: [{
                        data: [{{$totalPending}}, {{$totalSolved}}, {{max(0, $totalReports - ($totalPending+$totalSolved))}}],
                        backgroundColor: ['#facc15', '#22c55e', '#f3f4f6'],
                        borderWidth: 0
                    }]
                },
                options: { cutout: '75%', responsive: true, plugins: { legend: { position: 'bottom' } } }
            });
        }
    </script>

    <div id="chat-widget" class="fixed bottom-6 right-6 z-50">
    <button onclick="toggleChat()" class="bg-purple-700 hover:bg-purple-800 text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition-all transform hover:scale-110">
        <i class="fas fa-robot text-2xl"></i>
    </button>

    <div id="chat-box" class="hidden absolute bottom-16 right-0 w-80 bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">
        <div class="bg-purple-800 p-4 text-white flex justify-between items-center">
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt"></i>
                <span class="font-bold">UiTMGuard Bot</span>
            </div>
            <button onclick="toggleChat()" class="text-purple-200 hover:text-white">&times;</button>
        </div>
        
        <div id="chat-messages" class="h-64 overflow-y-auto p-4 bg-gray-50 space-y-3 text-sm">
            <div class="bg-purple-100 text-purple-900 p-3 rounded-tr-xl rounded-bl-xl rounded-br-xl w-3/4">
                Hello! I am the automated support bot. How can I help you?
            </div>
            <div class="flex gap-2 flex-wrap mt-2">
                <button onclick="askBot('report')" class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs hover:bg-purple-50">How to report?</button>
                <button onclick="askBot('status')" class="bg-white border border-purple-200 text-purple-700 px-3 py-1 rounded-full text-xs hover:bg-purple-50">Check Status</button>
                <button onclick="askBot('emergency')" class="bg-white border border-red-200 text-red-600 px-3 py-1 rounded-full text-xs hover:bg-red-50">Urgent Help</button>
            </div>
        </div>

        <div class="p-3 border-t bg-white flex gap-2">
            <input type="text" id="chat-input" placeholder="Type a message..." class="w-full text-sm outline-none bg-transparent" onkeypress="handleEnter(event)">
            <button onclick="sendMessage()" class="text-purple-700 font-bold"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<script>
    function toggleChat() {
        const box = document.getElementById('chat-box');
        box.classList.toggle('hidden');
    }

    function handleEnter(e) {
        if (e.key === 'Enter') sendMessage();
    }

    function sendMessage() {
        const input = document.getElementById('chat-input');
        const msg = input.value.trim();
        if (!msg) return;

        addMessage(msg, 'user');
        input.value = '';

        // Simple Rule-Based AI Logic
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
        
        // Auto scroll to bottom
        const container = document.getElementById('chat-messages');
        container.scrollTop = container.scrollHeight;
    }
</script>
</body>
</html>