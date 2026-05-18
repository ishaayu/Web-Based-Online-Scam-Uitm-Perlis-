<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Report | UiTMGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex h-screen items-center justify-center">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Report</h2>
        <form action="{{ route('report.update', $report->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Scam Type</label>
                <select name="report_type" class="w-full border p-3 rounded-lg bg-gray-50">
                    <option {{ $report->scam_type == 'Phishing Email' ? 'selected' : '' }}>Phishing Email</option>
                    <option {{ $report->scam_type == 'Phone/WhatsApp Scam' ? 'selected' : '' }}>Phone/WhatsApp Scam</option>
                    <option {{ $report->scam_type == 'Financial Fraud' ? 'selected' : '' }}>Financial Fraud</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full border p-3 rounded-lg bg-gray-50">{{ $report->description }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Update Evidence (Optional)</label>
                <input type="file" name="evidence" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-purple-50 file:text-purple-700"/>
                @if($report->evidence) <p class="text-xs text-green-600 mt-2">Current file attached.</p> @endif
            </div>

            <div class="flex gap-2">
                <a href="{{ route('report.index') }}" class="flex-1 text-center py-3 border rounded-lg text-gray-600 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="flex-1 bg-purple-700 text-white font-bold py-3 rounded-lg hover:bg-purple-800">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>