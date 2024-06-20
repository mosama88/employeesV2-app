<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        DB::table('appointments')->insert(
            [
                ['name'=>'السبت'],
            ]);
        DB::table('appointments')->insert(
            [
                ['name'=>'الأحد'],
            ]);
        DB::table('appointments')->insert(
            [
                ['name'=>'الإثنين'],
            ]);
        DB::table('appointments')->insert(
            [
                ['name'=>'الثلاثاء'],
            ]);
        DB::table('appointments')->insert(
            [
                ['name'=>'الأربعاء'],
            ]);
        DB::table('appointments')->insert(
            [
                ['name'=>'الخميس'],
            ]);
        DB::table('appointments')->insert(
            [
                ['name'=>'الجمعه'],
            ]);

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
