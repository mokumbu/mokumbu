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
        Schema::create('cards', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();

            $table->foreignUuid('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('bank_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('name');
            $table->string('description')->nullable();

            $table->decimal('balance', 15, 2)->default(0);

            $table->date('expires_at')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_frozen')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
