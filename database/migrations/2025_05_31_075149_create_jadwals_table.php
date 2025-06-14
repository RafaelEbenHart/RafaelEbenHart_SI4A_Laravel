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
            $table->string('tahun_akademik', 10);
            $table->enum('kode_smt', allowed: ['Gasal', 'Genap']);
            $table->string('kelas', 10);
            $table->foreignId('sesi_id')->constrained('sesi')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('dosen_id')->constrained('users')->onDelete('restrict')->onUpdate('restrict'); // Menggunakan 'users' sebagai tabel dosen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};