<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbEducationalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppdb_registration_id',
        'level',
        'school_name',
        'city',
        'graduation_year',
    ];

    public function ppdbRegistration(): BelongsTo
    {
        return $this->belongsTo(PpdbRegistration::class, 'ppdb_registration_id');
    }
}
