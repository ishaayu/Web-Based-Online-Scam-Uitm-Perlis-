<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UiTM Perlis - Student Scam Reporting</title>
    @include('partials.head-assets')
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="bg-purple-900 text-white text-center py-3 text-sm font-semibold tracking-wider">
        UiTM CAWANGAN PERLIS &bull; STUDENT SAFETY PORTAL
    </div>

    <div class="max-w-2xl mx-auto my-10 p-8 bg-white rounded-xl shadow-md border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Online Scam Reporting Form</h1>
            <p class="text-gray-500 text-sm mt-1">Report fraudulent activities directly to the campus authority.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student ID Number</label>
                    <input type="text" name="student_id" required placeholder="e.g. 2024123456" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="student_name" required placeholder="As per ID" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type of Scam</label>
                    <select name="scam_type" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none bg-white">
                        <option value="">Select Category</option>
                        <option value="Online Shopping / E-Commerce">Online Shopping / E-Commerce</option>
                        <option value="Phishing / Fake Link">Phishing / Fake Link</option>
                        <option value="Fake Rental / Accommodation">Fake Rental / Accommodation</option>
                        <option value="Job Offer Scam">Job Offer Scam</option>
                        <option value="Phishing Email">Phishing Email</option> <option value="Other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Incident</label>
                    <input type="date" name="incident_date" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Incident Description</label>
                <textarea name="description" rows="4" required placeholder="Provide details like links, social media handles, phone numbers, or how the incident happened..." 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Evidence (Screenshots/Receipts)</label>
                <input type="file" name="evidence" accept="image/*,application/pdf" required
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">
                
                <p class="text-xs text-amber-600 font-medium mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i> 
                    Note: To preserve documentation quality, files <strong>must be larger than 2MB</strong>.

                <p class="text-xs text-amber-600 font-medium mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i> 
                    Accepted formats: <strong>JPG,PNG and PDF</strong>
                </p>

                @error('evidence')
                    <p class="text-xs text-red-500 font-bold mt-1 flex items-center gap-1">
                        <i class="fas fa-times-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <button type="submit" 
                        class="w-full bg-purple-900 text-white font-semibold py-3 px-4 rounded-lg hover:bg-purple-800 transition shadow-md cursor-pointer">
                    Submit Report to Auxiliary Police
                </button>
            </div>
        </form>
    </div>

</body>
</html>