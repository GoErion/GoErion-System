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
        Schema::create('payouts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('escrow_id')->index();
            $table->string('recipient_type')->index();
            $table->uuid('recipient_id')->index()->index();
            $table->decimal('amount', 10, 2)->index();
            $table->string('method');
            $table->string('status');
            $table->string('reference')->unique()->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('escrow_id')->references('id')->on('escrows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
