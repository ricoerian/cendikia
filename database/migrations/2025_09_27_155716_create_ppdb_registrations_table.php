<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('status')->default('pending');
            $table->foreignId('first_choice_major_id')->nullable()->constrained('majors');
            $table->foreignId('second_choice_major_id')->nullable()->constrained('majors');
            $table->string('name');
            $table->string('nisn')->unique()->nullable();
            $table->string('nik_student')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('citizenship')->nullable();
            $table->integer('child_order_in_family')->nullable();
            $table->integer('number_of_siblings')->nullable();
            $table->text('address');
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('transportation_mode')->nullable();
            $table->integer('distance_to_school')->nullable();
            $table->string('family_card_number')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_nik')->nullable();
            $table->date('father_birth_date')->nullable();
            $table->string('father_education')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_income')->nullable();
            $table->string('father_religion')->nullable();
            $table->text('father_address')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_nik')->nullable();
            $table->date('mother_birth_date')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_income')->nullable();
            $table->string('mother_religion')->nullable();
            $table->text('mother_address')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone_number')->nullable();
            $table->text('guardian_address')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('blood_type')->nullable();
            $table->text('medical_history')->nullable();
            $table->string('kip_number')->nullable();
            $table->string('kps_number')->nullable();
            $table->json('documents')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};
