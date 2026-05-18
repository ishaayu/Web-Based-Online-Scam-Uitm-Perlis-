<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel | UiTMGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <aside class="w-64 bg-gray-900 text-white flex flex-col shadow-2xl">
        <div class="h-20 flex items-center justify-center border-b border-gray-800">
            <span class="font-bold text-xl tracking-wide">ADMIN<span class="text-red-500">PANEL</span></span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="#" class="flex items-center gap-4 px-4 py-3 bg-red-600 rounded-lg text-white shadow-md">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </nav>
        <div class="p-4 border-t border-gray-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf <button class="text-gray-400 hover:text-white text-sm">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Admin Overview</h1>

        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                <p class="text-gray-500 text-xs uppercase font-bold">Total Students</p>
                <p class="text-3xl font-bold">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
                <p class="text-gray-500 text-xs uppercase font-bold">Pending Cases</p>
                <p class="text-3xl font-bold">{{ $pendingReports }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50 font-bold text-gray-700">All Student Reports</div>
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="p-4">Student</th>
                        <th class="p-4">Type</th>
                        <th class="p-4">Evidence</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach($reports as $report)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4">
                            <p class="font-bold text-gray-800">{{ $report->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $report->user->email }}</p>
                        </td>
                        <td class="p-4">{{ $report->scam_type }}</td>
                        <td class="p-4">
                            @if($report->evidence)
                                <a href="{{ asset('storage/'.$report->evidence) }}" target="_blank" class="text-blue-600 underline">View Img</a>
                            @else
                                <span class="text-gray-400">None</span>
                            @endif
                        </td>
                        <td class="p-4">
                            @if($report->status == 'Pending')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Pending</span>
                            @else
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Resolved</span>
                            @endif
                        </td>
                        <td class="p-4 text-right flex justify-end gap-2">
                            @if($report->status == 'Pending')
                                <form action="{{ route('admin.resolve', $report->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">
                                        <i class="fas fa-check"></i> Solve
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.delete', $report->id) }}" method="POST" onsubmit="return confirm('Delete this report?');">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

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