<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Submitted Cases</title>
    @include('partials.head-assets')
</head>
<body class="bg-slate-50 p-4 md:p-8 min-h-screen">

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Your Submitted Case History</h1>
            <a href="{{ route('report.create') }}" class="bg-purple-950 text-white text-sm font-bold px-4 py-2 rounded-xl">New Report</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-xl text-sm mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs font-bold uppercase border-b border-slate-100">
                    <tr>
                        <th class="p-4">Case ID</th>
                        <th class="p-4">Type</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Document Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($reports as $report)
                    <tr>
                        <td class="p-4 font-mono font-bold text-purple-950">#SR-{{ $report->id }}</td>
                        <td class="p-4 text-slate-700">{{ $report->scam_type }}</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $report->status === 'Resolved' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $report->status }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            @if($report->status === 'Resolved')
                                <a href="{{ route('report.generate', $report->id) }}" target="_blank" class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-blue-600 hover:text-white transition">
                                    Generate Notice
                                </a>
                            @else
                                <span class="text-xs text-slate-400 italic">Under Processing</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-slate-400">No reports found under your profile history.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>