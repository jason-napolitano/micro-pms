<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('make_ready_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('status')->default(\App\Models\Enums\MakeReadyStatus::PENDING);
            $table->decimal('estimated_cost', 10, 2)->nullable()->default(null);
            $table->decimal('actual_cost', 10, 2)->nullable()->default(null);
            $table->text('notes')->nullable()->default(null);

            $table->foreignUuid('make_ready_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('item_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('assigned_to')
                ->nullable()
                ->default(null)
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignUuid('vendor_id')
                ->nullable()
                ->default(null)
                ->constrained('vendors')
                ->nullOnDelete();

            $table->dateTime('scheduled_start_at')->nullable()->default(null);
            $table->dateTime('scheduled_end_at')->nullable()->default(null);
            $table->dateTime('completed_at')->nullable()->default(null);
            $table->dateTime('on_hold_at')->nullable()->default(null);
            $table->dateTime('cancelled_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'make_ready_id',
                'assigned_to',
                'vendor_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('make_ready_items');
    }
};
