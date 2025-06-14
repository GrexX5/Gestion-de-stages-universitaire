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
        Schema::create('offers', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('company_id');
    $table->string('title');
    $table->string('location');
    $table->string('duration');
    $table->text('description');
    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->timestamps();

    $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
