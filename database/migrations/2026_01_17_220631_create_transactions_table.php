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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();

            $table->foreignUuid('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('card_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('expense_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignUuid('category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('type', ['income', 'expense']);

            $table->decimal('amount', 15, 2);

            // auditoria de saldo
            $table->decimal('balance_before', 15, 2);
            $table->decimal('balance_after', 15, 2);

            $table->datetime('transaction_date');
            $table->string('description')->nullable();

            $table->index(['user_id', 'card_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
