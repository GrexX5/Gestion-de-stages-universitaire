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
        Schema::create('conventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_supervisor_id')->nullable()->constrained('company_contacts')->onDelete('set null');
            $table->foreignId('school_supervisor_id')->nullable()->constrained('teachers')->onDelete('set null');
            $table->string('convention_number')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('working_hours_per_week');
            $table->decimal('gross_salary', 10, 2)->nullable();
            $table->text('mission_description');
            $table->text('skills_developed')->nullable();
            $table->enum('status', ['draft', 'pending', 'validated', 'signed', 'rejected', 'cancelled'])->default('draft');
            $table->date('validation_date')->nullable();
            $table->date('signature_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('document_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conventions');
    }
};
