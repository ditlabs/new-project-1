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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama klien
            $table->string('title'); // Jabatan/posisi klien, cth: "Power User"
            $table->text('quote'); // Isi testimoni
            $table->string('avatar')->nullable(); // Path untuk foto profil klien
            $table->boolean('is_visible')->default(false); // Untuk approval admin
            $table->timestamps();
        });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
