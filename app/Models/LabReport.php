<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabReport extends Model
{
    use HasFactory;

    protected $fillable = ['lab_request_id', 'results'];

    protected $casts = [
        'results' => 'array',
    ];

    public function labRequest(): BelongsTo
    {
        return $this->belongsTo(LabRequest::class);
    }
}
