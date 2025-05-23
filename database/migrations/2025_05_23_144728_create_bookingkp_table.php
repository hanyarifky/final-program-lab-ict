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
        Schema::create('booking_kp', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangan')->onDelete('cascade');
            $table->string("pertemuan");
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
