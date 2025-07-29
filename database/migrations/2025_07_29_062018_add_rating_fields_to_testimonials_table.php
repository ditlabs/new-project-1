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
        Schema::table('testimonials', function (Blueprint $table) {
            // Kolom-kolom baru untuk fungsionalitas rating
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('id');
            $table->foreignId('produk_id')->nullable()->constrained()->onDelete('set null')->after('user_id');
            $table->unsignedTinyInteger('rating')->nullable()->after('quote'); // Rating bintang 1-5

            // Ubah beberapa kolom yang ada agar bisa null
            $table->string('name')->nullable()->change();
            $table->string('title')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            //
        });
    }
};
