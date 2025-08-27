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
        Schema::table('appointments', function (Blueprint $table) {

            $table->dropForeign(['status_id']);
            $table->unsignedBigInteger('status_id')->default(1)->change();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->unsignedBigInteger('status_id')->change();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }
};
