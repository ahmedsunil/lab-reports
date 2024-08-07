<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LabRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'patient_id', 'status'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
            $model->status = 'pending';
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function tests(): BelongsToMany
    {
        return $this->belongsToMany(Test::class, 'lab_reports')->withPivot('results');
    }
}
