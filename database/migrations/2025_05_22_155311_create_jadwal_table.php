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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangan')->onDelete('cascade');
            // $table->enum('hari', ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu"]);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
        });

        Schema::create('jadwal_detail', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('pertemuan');
            $table->date('tanggal');
            $table->string('status')->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_detail');
        Schema::dropIfExists('jadwal');
    }
};
