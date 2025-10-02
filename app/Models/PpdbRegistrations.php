<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpdbRegistrations extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'registration_number', 'status', 'first_choice_major_id', 'second_choice_major_id',
        'name', 'nisn', 'nik_student', 'gender', 'place_of_birth', 'date_of_birth',
        'religion', 'citizenship', 'child_order_in_family', 'number_of_siblings',
        'address', 'phone_number', 'email', 'photo', 'transportation_mode', 'distance_to_school',
        'family_card_number', 'father_name', 'father_nik', 'father_birth_date',
        'father_education', 'father_occupation', 'father_income', 'father_religion',
        'father_address', 'mother_name', 'mother_nik', 'mother_birth_date',
        'mother_education', 'mother_occupation', 'mother_income', 'mother_religion',
        'mother_address', 'guardian_name', 'guardian_phone_number', 'guardian_address',
        'guardian_relationship', 'height', 'weight', 'blood_type', 'medical_history',
        'kip_number', 'kps_number', 'documents', 'reference_source', 'reference_details'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'father_birth_date' => 'date',
        'mother_birth_date' => 'date',
        'documents' => 'array',
    ];

    public function firstChoiceMajor(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'first_choice_major_id');
    }

    public function secondChoiceMajor(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'second_choice_major_id');
    }

    public function educationalHistories(): HasMany
    {
        return $this->hasMany(PpdbEducationalHistory::class, 'ppdb_registration_id');
    }

    public function siblings(): HasMany
    {
        return $this->hasMany(PpdbSibling::class, 'ppdb_registration_id');
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(PpdbAchievement::class, 'ppdb_registration_id');
    }
}
