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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade')
                  ->nullable(false);
            $table->string('name');
            $table->string('siret', 14)->unique();
            $table->string('naf_code', 10)->nullable();
            $table->string('legal_status');
            $table->string('contact_first_name');
            $table->string('contact_last_name');
            $table->string('contact_position');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('postal_code', 10);
            $table->string('country')->default('France');
            $table->string('logo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_partner')->default(false);
            $table->date('partnership_start_date')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
