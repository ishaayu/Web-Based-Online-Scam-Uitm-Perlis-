<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'scam_type', 'description', 'evidence_path', 'status', 'admin_notes'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}