<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Reports | UiTMGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex h-screen">
    <aside class="w-72 bg-[#2e1065] text-white flex flex-col p-6">
        <div class="mb-8 text-2xl font-bold">UiTM<span class="text-yellow-400">Guard</span></div>
        <nav class="space-y-4">
            <a href="{{ route('dashboard') }}" class="block text-purple-200 hover:text-white">Dashboard</a>
            <a href="{{ route('report.index') }}" class="block text-white font-bold">My Reports</a>
            <a href="{{ route('report.create') }}" class="block text-purple-200 hover:text-white">New Report</a>
        </nav>
    </aside>

    <main class="flex-1 p-10 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">History</h1>
            <a href="{{ route('report.create') }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg font-bold shadow-md hover:bg-purple-700">+ New</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border-l-4 border-green-500">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold">
                    <tr><th class="p-6">Date</th><th class="p-6">Type</th><th class="p-6">Status</th><th class="p-6 text-right">Action</th></tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($myReports as $report)
                    <tr class="hover:bg-purple-50/50 transition">
                        <td class="p-6 text-gray-600">{{ $report->created_at->format('d M, Y') }}</td>
                        <td class="p-6 font-bold text-gray-800">{{ $report->scam_type }}</td>
                        <td class="p-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $report->status == 'Resolved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $report->status }}
                            </span>
                        </td>
                        <td class="p-6 text-right">
    @if($report->status == 'Pending')
        <span class="text-yellow-600 text-xs font-bold italic">
            <i class="fas fa-clock"></i> Waiting for Admin
        </span>
                @else
        <span class="text-green-600 text-xs font-bold italic">
                                <i class="fas fa-check-double"></i> Action Taken
                             </span>
                        @endif
                    </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-12 text-center text-gray-400">No reports found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>