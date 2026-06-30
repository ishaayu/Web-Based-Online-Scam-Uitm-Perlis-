<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary Report #{{ $report->id }} | UiTMGuard</title>
    @include('partials.head-assets')
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; }
            .print-border { border: 1px solid #e5e7eb !important; }
        }
    </style>
</head>
<body class="bg-gray-100 p-8 font-sans text-gray-800">

    <div class="max-w-4xl mx-auto mb-6 flex justify-between items-center no-print">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
        <button onclick="window.print()" class="bg-purple-700 hover:bg-purple-800 text-white px-6 py-2 rounded-lg font-bold shadow-md transition flex items-center gap-2">
            <i class="fas fa-print"></i> Print / Save as PDF
        </button>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-10 rounded-xl shadow-lg print-border">
        
        <div class="border-b-2 border-gray-800 pb-6 mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">INCIDENT SUMMARY REPORT</h1>
                <p class="text-sm font-bold text-gray-500 mt-1 uppercase">UiTM Auxiliary Police Department</p>
            </div>
            <div class="text-right">
                <p class="text-xl font-bold text-purple-700">Case #{{ str_pad($report->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="text-sm text-gray-500 mt-1 font-mono">Date: {{ $report->created_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>

        <div class="mb-8 p-4 rounded-lg flex items-center gap-3 font-bold uppercase tracking-wider text-sm {{ $report->status == 'Resolved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
            <i class="fas {{ $report->status == 'Resolved' ? 'fa-check-circle' : 'fa-clock' }} text-lg"></i>
            Current Status: {{ $report->status }}
        </div>

        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="text-lg font-bold border-b border-gray-200 pb-2 mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-user-graduate text-gray-400"></i> Complainant Details
                </h2>
                <div class="space-y-3 text-sm">
                    <p><span class="font-bold text-gray-600 inline-block w-24">Name:</span> {{ $report->user->name }}</p>
                    <p><span class="font-bold text-gray-600 inline-block w-24">Email:</span> {{ $report->user->email }}</p>
                    <p><span class="font-bold text-gray-600 inline-block w-24">Student ID:</span> {{ $report->user->student_id ?? 'N/A' }}</p>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-bold border-b border-gray-200 pb-2 mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-gray-400"></i> Incident Details
                </h2>
                <div class="space-y-3 text-sm">
                    <p><span class="font-bold text-gray-600 inline-block w-24">Scam Type:</span> <span class="bg-gray-100 px-2 py-1 rounded font-semibold">{{ $report->scam_type }}</span></p>
                    <p><span class="font-bold text-gray-600 inline-block w-24">Logged At:</span> {{ $report->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-lg font-bold border-b border-gray-200 pb-2 mb-4 text-gray-700 flex items-center gap-2">
                <i class="fas fa-align-left text-gray-400"></i> Statement / Description
            </h2>
            <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $report->description }}</div>
        </div>

        <div class="mb-8">
            <h2 class="text-lg font-bold border-b border-gray-200 pb-2 mb-4 text-gray-700 flex items-center gap-2">
                <i class="fas fa-paperclip text-gray-400"></i> Attached Evidence
            </h2>
            @if($report->evidence)
                <div class="no-print mb-4">
                    <a href="{{ asset('storage/'.$report->evidence) }}" target="_blank" class="text-blue-600 hover:underline text-sm font-bold flex items-center gap-2">
                        <i class="fas fa-external-link-alt"></i> Open evidence in new tab
                    </a>
                </div>
                <div class="border-2 border-dashed border-gray-300 p-2 rounded-lg bg-gray-50 max-w-md">
                    <img src="{{ asset('storage/'.$report->evidence) }}" alt="Evidence Attachment" class="w-full h-auto rounded">
                </div>
            @else
                <p class="text-gray-500 italic text-sm">No digital evidence was attached to this report.</p>
            @endif
        </div>

        <div class="mt-16 pt-8 border-t border-gray-300 grid grid-cols-2 gap-8 text-center text-sm">
            <div>
                <div class="w-48 mx-auto border-b border-gray-400 h-16 mb-2"></div>
                <p class="font-bold text-gray-700">Complainant Signature</p>
                <p class="text-gray-500">{{ $report->user->name }}</p>
            </div>
            <div>
                <div class="w-48 mx-auto border-b border-gray-400 h-16 mb-2"></div>
                <p class="font-bold text-gray-700">Investigating Officer</p>
                <p class="text-gray-500">UiTMGuard Administrator</p>
            </div>
        </div>

    </div>
</body>
</html>