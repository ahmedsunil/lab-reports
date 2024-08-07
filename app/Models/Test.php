<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function labRequests(): BelongsToMany
    {
        return $this->belongsToMany(LabRequest::class, 'lab_reports');
    }

}
