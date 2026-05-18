<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit Report | UiTMGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <aside class="w-64 bg-[#2e1065] text-white flex flex-col shadow-2xl z-20">
        <div class="h-24 flex items-center justify-center border-b border-purple-900/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shield-alt text-purple-900 text-xl"></i>
                </div>
                <span class="font-bold text-xl">UiTM<span class="text-yellow-400">Guard</span></span>
            </div>
        </div>
        <nav class="flex-1 px-4 py-8 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 text-purple-200 hover:bg-white/10 rounded-xl transition-all">
                <i class="fas fa-chart-pie w-5"></i> <span class="text-sm">Dashboard</span>
            </a>
            <a href="{{ route('report.index') }}" class="flex items-center gap-4 px-4 py-3 text-purple-200 hover:bg-white/10 rounded-xl transition-all">
                <i class="fas fa-folder-open w-5"></i> <span class="text-sm">My Reports</span>
            </a>
            <a href="{{ route('report.create') }}" class="flex items-center gap-4 px-4 py-3 bg-purple-800 text-white rounded-xl shadow-lg">
                <i class="fas fa-plus-circle w-5 text-yellow-400"></i> <span class="text-sm font-bold">New Report</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto bg-gray-50">
        <div class="bg-white border-b px-8 py-4 flex justify-between items-center">
            <h2 class="text-lg font-bold text-purple-900">Security Portal</h2>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                <div class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center text-xs font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        <div class="p-8 lg:p-12 max-w-5xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Submit <span class="text-purple-700">New Report</span></h1>
                <p class="text-gray-500">Please provide accurate details to help our security team investigate.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-800 to-purple-900 px-8 py-5">
                    <p class="text-white font-medium flex items-center gap-2">
                        <i class="fas fa-info-circle text-yellow-400"></i> Incident Information
                    </p>
                </div>

                <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700 ml-1">Scam Type</label>
                            <select name="type" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none transition-all text-gray-800">
                                <option>Phishing Email</option>
                                <option>Fake Website</option>
                                <option>Phone Scam</option>
                                <option>Social Media Fraud</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700 ml-1">Evidence (Screenshot)</label>
                            <input type="file" name="evidence" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200 cursor-pointer">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700 ml-1">Description</label>
                        <textarea name="description" rows="4" placeholder="Briefly describe the incident..." class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 outline-none transition-all"></textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-purple-900 hover:bg-purple-800 text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-purple-200 transition-all flex items-center gap-2">
                            Submit Report <i class="fas fa-paper-plane text-yellow-400"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>