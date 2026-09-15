<?php

namespace App\Models {

    use App\Models\Enums\MakeReadyStatus;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\Relations;

    /**
     * @property array<MakeReadyItem> $items
     * @property Unit $unit
     */
    class MakeReady extends BaseModel
    {
        /** @inheritdoc */
        protected $fillable = [
            'completed_at',
            'expected_at',
            'started_at',
            'unit_id',
            'status',
            'notes',
        ];

        // ------------------------------------------------
        // casts

        protected function casts(): array
        {
            return [
                'status'       => MakeReadyStatus::class,
                'moveout_at'   => 'datetime',
                'targeted_at'  => 'datetime',
                'started_at'   => 'datetime',
                'completed_at' => 'datetime',
            ];
        }

        // ------------------------------------------------
        // relations

        public function unit(): Relations\BelongsTo
        {
            return $this->belongsTo(Unit::class);
        }

        public function items(): Relations\HasMany
        {
            return $this->hasMany(MakeReadyItem::class);
        }

        // ------------------------------------------------
        // attributes

        protected function startedAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }

        protected function expectedAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }

        protected function completedAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }
    }
}
