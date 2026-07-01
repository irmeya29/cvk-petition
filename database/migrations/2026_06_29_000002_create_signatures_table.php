<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petition_id')->constrained()->cascadeOnDelete();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 190);
            $table->boolean('display_name')->default(true);
            $table->boolean('accepted_terms')->default(false);
            $table->boolean('accepted_data_policy')->default(false);
            $table->timestamp('signed_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->unique(['petition_id', 'email']);
            $table->index(['petition_id', 'display_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
