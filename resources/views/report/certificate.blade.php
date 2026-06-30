<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Resolution Sheet - #SR-{{ $report->id }}</title>
    @include('partials.head-assets')
    <style>@media print { .no-print { display: none; } }</style>
</head>
<body class="bg-slate-100 py-12 text-slate-900">

    <div class="max-w-2xl mx-auto mb-4 no-print flex justify-between bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <span class="text-sm text-slate-500 self-center">Verification document built successfully.</span>
        <button onclick="window.print()" class="bg-purple-950 text-white font-bold text-xs px-4 py-2 rounded-lg cursor-pointer">Print / Save PDF</button>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-12 shadow-sm border border-slate-200 rounded-sm">
        <div class="border-b-4 border-purple-950 pb-4 text-center">
            <h1 class="text-lg font-black text-purple-950">PEJABAT POLIS BANTUAN (AUXILIARY POLICE)</h1>
            <p class="text-xs uppercase font-bold text-slate-400 tracking-wider">Universiti Teknologi MARA Cawangan Perlis, Kampus Arau</p>
        </div>
        <div class="my-6 flex justify-between text-xs font-mono text-slate-400">
            <div>REF: UiTM/PB/{{ date('Y') }}/00{{ $report->id }}</div>
            <div>DATE: {{ date('d M Y') }}</div>
        </div>
        <h2 class="text-center font-bold text-sm underline uppercase mb-6">CASE RESOLUTION NOTICE</h2>
        <div class="bg-slate-50 p-4 rounded border border-slate-100 space-y-2 text-xs mb-6">
            <div><strong>Complainant:</strong> {{ $report->student_name }}</div>
            <div><strong>Student Identifier:</strong> {{ $report->student_id }}</div>
            <div><strong>Classification:</strong> {{ $report->scam_type }}</div>
            <div><strong>Status Parameter:</strong> <span class="text-green-600 font-bold">CASE FILE CLOSED</span></div>
        </div>
        <p class="text-xs text-slate-700 leading-relaxed mb-12">
            This instrument acts to officially verify that the technical review regarding the submitted cyber case context has been formally completed by campus law enforcement components. Reference markers have been securely updated within organizational databanks.
        </p>
        <div class="border-t border-slate-100 pt-4 text-xs">
            <p class="font-bold text-purple-950">CASE MANAGEMENT DETACHMENT</p>
            <p class="text-slate-400">Auxiliary Police Services Division</p>
        </div>
    </div>

</body>
</html>