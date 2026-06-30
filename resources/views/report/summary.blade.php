<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Incident Resolution Report</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; color: #2d3748; line-height: 1.6; padding: 20px; }
        .header { text-align: center; border-bottom: 3px solid #5c20a6; padding-bottom: 15px; margin-bottom: 30px; }
        .title { font-size: 24px; font-weight: bold; color: #5c20a6; text-transform: uppercase; margin: 0; }
        .subtitle { font-size: 12px; color: #718096; letter-spacing: 1px; margin-top: 5px; }
        .section-title { font-size: 14px; font-weight: bold; color: #4a157d; border-bottom: 1px solid #e2e8f0; padding-bottom: 5px; margin-top: 20px; text-transform: uppercase; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table th, .table td { border: 1px solid #e2e8f0; padding: 12px; text-align: left; font-size: 13px; }
        .table th { background-color: #f7fafc; color: #4a5568; font-weight: bold; }
        .badge { background-color: #2f855a; color: white; padding: 4px 10px; border-radius: 12px; font-weight: bold; font-size: 11px; display: inline-block; }
        .footer { margin-top: 50px; text-align: center; font-size: 11px; color: #a0aec0; border-top: 1px solid #e2e8f0; padding-top: 15px; }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">Polis Bantuan UiTM Perlis</div>
        <div class="subtitle">Official Incident Resolution Profile & Summary Report</div>
    </div>

    <table class="table">
        <tr>
            <th style="width: 30%;">Case Reference ID</th>
            <td><strong>#{{ $report->id }}</strong></td>
        </tr>
        <tr>
            <th>Current Status</th>
            <td><span class="badge">RESOLVED / SOLVED</span></td>
        </tr>
        <tr>
            <th>Date Resolved</th>
            <td>{{ $report->updated_at->format('d F Y, g:i A') }}</td>
        </tr>
    </table>

    <div class="section-title">Incident Details</div>
    <table class="table">
        <tr>
            <th style="width: 30%;">Category / Scam Type</th>
            <td>{{ $report->scam_type }}</td>
        </tr>
        <tr>
            <th>Complainant Name</th>
            <td>{{ $report->user->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Complainant Email</th>
            <td>{{ $report->user->email ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="footer">
        This is a system-generated document authorized by the Auxiliary Police Department of UiTM Perlis.<br>
        No physical signature is required. For verification inquiries, please contact the security desk.
    </div>

</body>
</html>