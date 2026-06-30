<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scam_reports', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('student_name');
            $table->string('scam_type'); // e.g., Phishing, Fake Buyer, Job Scam
            $table->text('description');
            $table->date('incident_date');
            $table->string('evidence_attachment')->nullable(); // For screenshots
            $table->enum('status', ['Pending', 'Investigating', 'Resolved'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scam_reports');
    }
};