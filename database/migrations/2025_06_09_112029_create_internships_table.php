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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('supervisor_id')->nullable()->constrained('teachers')->onDelete('set null');
            $table->string('title');
            $table->text('description');
            $table->text('required_skills')->nullable();
            $table->text('benefits')->nullable();
            $table->enum('type', ['stage', 'alternance', 'projet']);
            $table->enum('duration', ['1-2 mois', '3-4 mois', '5-6 mois', '6+ mois']);
            $table->enum('work_schedule', ['plein_temps', 'partiel', 'flexible']);
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('location');
            $table->boolean('remote_allowed')->default(false);
            $table->integer('available_positions')->default(1);
            $table->date('start_date');
            $table->date('end_date');
            $table->date('application_deadline');
            $table->enum('status', ['draft', 'published', 'closed', 'archived'])->default('draft');
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
