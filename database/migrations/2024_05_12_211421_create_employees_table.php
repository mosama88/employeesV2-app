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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('alter_phone')->nullable();
            $table->date('hiring_date')->nullable();
            $table->date('start_from')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('num_of_days')->nullable();
            $table->string('add_service')->nullable();
            $table->string('years_service')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('job_grades_id')->references('id')->on('job_grades')->onDelete('cascade');
            $table->foreignId('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreignId('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplyees');
    }
};
