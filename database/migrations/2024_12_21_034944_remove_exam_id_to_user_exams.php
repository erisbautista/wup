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
        Schema::table('user_exams', function (Blueprint $table) {
            $table->dropColumn('result');
            $table->dropForeign(['exam_id']);
            $table->dropColumn('exam_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_exams', function (Blueprint $table) {
            $table->string('result');
            $table->unsignedBigInteger('exam_id');
        });
    }
};
