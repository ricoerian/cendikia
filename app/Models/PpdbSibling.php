<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbSibling extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppdb_registration_id',
        'name',
        'gender',
        'date_of_birth',
        'current_school_or_occupation',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function ppdbRegistration(): BelongsTo
    {
        return $this->belongsTo(PpdbRegistration::class, 'ppdb_registration_id');
    }
}
