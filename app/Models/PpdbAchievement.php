<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppdb_registration_id',
        'achievement_name',
        'level',
        'year',
        'description',
    ];

    public function ppdbRegistration(): BelongsTo
    {
        return $this->belongsTo(PpdbRegistration::class, 'ppdb_registration_id');
    }
}
