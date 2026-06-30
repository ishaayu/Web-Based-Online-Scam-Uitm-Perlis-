<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Notifications\CaseSolvedNotification;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function solveCase(Request $request, $id)
    {
        // 1. Find the case/report
        $report = Report::findOrFail($id);

        // 2. Update the status to solved
        $report->status = 'solved';
        $report->save();

        // 3. Get the student who created the report
        // (Assuming your Report model has a 'user' relationship)
        $student = $report->user; 

        if ($student) {
            // 4. Send the email notification to the student
            $student->notify(new CaseSolvedNotification($report));
        }

        return redirect()->back()->with('success', 'Case marked as solved and student notified via email!');
    }
}