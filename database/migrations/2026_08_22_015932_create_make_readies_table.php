<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Enums\MakeReadyStatus;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('make_readies', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('status')->default(MakeReadyStatus::PENDING);

            $table->dateTime('started_at')->nullable();
            $table->dateTime('expected_at')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->text('notes')->nullable()->default(null);

            $table->foreignUuid('unit_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'started_at',
                'expected_at',
                'completed_at',
                'unit_id',
                'status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('make_readies');
    }
};
