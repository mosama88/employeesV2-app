<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->timestamps();
        });

            DB::table('addresses')->insert(
            [
            ['city'=>'القاهرة'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'الجيزه'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'الاسكندرية'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'الإسماعيلية'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'الدقهلية'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'أسيوط'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'السويس'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'القليوبية'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'البحيرة'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'الغربية'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'دمياط'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'كفرالشيخ'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'سوهاج'],
            ]);
            DB::table('addresses')->insert(
            [
            ['city'=>'الأقصر'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'أسوان'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'الواحات'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'الوادي الجديد'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'البحر الأحمر'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'قنا'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'المنيا'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'جنوب سيناء'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'شمال سيناء'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'مطروح'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'بنها'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'الفيوم'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'بنى سويف'],
            ]);
            DB::table('addresses')->insert(
            [
                ['city'=>'الشرقيه'],
            ]);

            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
