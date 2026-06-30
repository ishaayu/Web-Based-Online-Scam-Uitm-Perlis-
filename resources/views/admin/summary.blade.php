<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Summary Report - Polis Bantuan UiTM</title>
    @include('partials.head-assets')
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; }
        }
    </style>
</head>
<body class="bg-gray-100 p-8 font-sans text-gray-800">

    <div class="max-w-5xl mx-auto bg-white p-10 rounded-xl shadow-xl border-t-8 border-gray-900">
        
        <div class="flex justify-between items-end border-b-2 border-gray-200 pb-6 mb-8">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tight text-gray-900">System Master Report</h1>
                <p class="text-gray-500 font-medium mt-1">Polis Bantuan UiTM Perlis - Security & Fraud Division</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Generated On</p>
                <p class="text-lg font-bold text-purple-800">{{ now()->format('d F Y, h:i A') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mb-10">
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 text-center">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Total Cases</p>
                <p class="text-4xl font-black text-gray-800">{{ $totalCases }}</p>
            </div>
            <div class="bg-amber-50 p-6 rounded-lg border border-amber-200 text-center">
                <p class="text-xs font-bold text-amber-600 uppercase tracking-widest mb-2">Pending Investigation</p>
                <p class="text-4xl font-black text-amber-700">{{ $pendingCases }}</p>
            </div>
            <div class="bg-emerald-50 p-6 rounded-lg border border-emerald-200 text-center">
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-2">Cases Resolved</p>
                <p class="text-4xl font-black text-emerald-700">{{ $resolvedCases }}</p>
            </div>
        </div>

        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Full Incident Log</h2>
        <table class="w-full text-left border-collapse mb-10">
            <thead>
                <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="p-3 border-b">Case ID</th>
                    <th class="p-3 border-b">Complainant</th>
                    <th class="p-3 border-b">Category</th>
                    <th class="p-3 border-b">Date Filed</th>
                    <th class="p-3 border-b text-right">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($reports as $report)
                <tr class="border-b border-gray-100">
                    <td class="p-3 font-mono text-xs text-gray-500">#PB-{{ str_pad($report->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-3 font-bold">{{ $report->user->name ?? 'Unknown' }}</td>
                    <td class="p-3 text-purple-700 font-semibold">{{ $report->scam_type }}</td>
                    <td class="p-3 text-gray-500">{{ $report->created_at->format('d/m/Y') }}</td>
                    <td class="p-3 text-right">
                        @if($report->status == 'Pending')
                            <span class="text-amber-600 font-bold uppercase text-xs">Pending</span>
                        @else
                            <span class="text-emerald-600 font-bold uppercase text-xs">Resolved</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-400 italic">No reports recorded in the system yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-16 flex justify-between px-10">
            <div class="text-center">
                <div class="border-b border-gray-400 w-48 mb-2"></div>
                <p class="text-xs font-bold uppercase text-gray-500">Prepared By</p>
            </div>
            <div class="text-center">
                <div class="border-b border-gray-400 w-48 mb-2"></div>
                <p class="text-xs font-bold uppercase text-gray-500">Verified By (Chief Officer)</p>
            </div>
        </div>

        <div class="mt-16 text-center no-print border-t pt-8">
            <button onclick="window.print()" class="bg-gray-900 hover:bg-black text-white font-bold py-3 px-8 rounded-lg shadow-lg transition cursor-pointer flex items-center justify-center gap-2 mx-auto">
                <i class="fas fa-print"></i> Print Official Report
            </button>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-purple-600 mt-4 inline-block hover:underline">&larr; Back to Dashboard</a>
        </div>

    </div>

</body>
</html>