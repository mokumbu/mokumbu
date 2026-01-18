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
        Schema::create('debtor_transactions', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();

            $table->foreignUuid('debtor_id')
                ->constrained()
                ->cascadeOnDelete();

            // impacto no saldo do devedor
            $table->decimal('amount', 15, 2);

            $table->decimal('balance_before', 15, 2);
            $table->decimal('balance_after', 15, 2);

            $table->string('description')->nullable();

            $table->timestamps();

            $table->unique(['debtor_id', 'transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debtor_transactions');
    }
};
