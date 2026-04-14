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
        Schema::create('blastings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama target
            $table->string('agent_id'); // ID Agen
            $table->string('department_id'); // ID Departemen
            $table->string('broadcast_id'); // ID Broadcast
            $table->string('phone'); // Nomor Telepon
            $table->string('language')->default('id'); // Bahasa
            $table->timestamp('broadcast_time')->nullable(); // Waktu kirim
            $table->string('status_response')->nullable(); // Status (sent, failed, dll)
            $table->string('template_name'); // Nama Template yang dipakai
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blastings');
    }
};
