<?php

namespace App\Models {

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\Relations;
    use App\Models\Enums\MakeReadyPriority;
    use App\Models\Enums\MakeReadyStatus;

    /**
     * @property MakeReady $makeReady
     * @property ItemType $type
     * @property User $assignee
     * @property Vendor $vendor
     */
    class MakeReadyItem extends BaseModel
    {
        /** @inheritdoc */
        protected $fillable = [
            'scheduled_start_at',
            'scheduled_end_at',
            'estimated_cost',
            'make_ready_id',
            'item_type_id',
            'cancelled_at',
            'completed_at',
            'description',
            'assigned_to',
            'actual_cost',
            'on_hold_at',
            'vendor_id',
            'status',
            'notes',
        ];

        // ------------------------------------------------
        // casts
        protected function casts(): array
        {
            return [
                'status'         => MakeReadyStatus::class,
                'priority'       => MakeReadyPriority::class,
                'scheduled_at'   => 'datetime',
                'due_at'         => 'datetime',
                'started_at'     => 'datetime',
                'completed_at'   => 'datetime',
                'cancelled_at'   => 'datetime',
                'estimated_cost' => 'decimal:2',
                'actual_cost'    => 'decimal:2',
            ];
        }

        // ------------------------------------------------
        // relations
        public function makeReady(): Relations\BelongsTo
        {
            return $this->belongsTo(MakeReady::class);
        }

        public function type(): Relations\BelongsTo
        {
            return $this->belongsTo(ItemType::class, 'item_type_id');
        }

        public function assignee(): Relations\BelongsTo
        {
            return $this->belongsTo(User::class, 'assigned_to');
        }

        public function vendor(): Relations\BelongsTo
        {
            return $this->belongsTo(Vendor::class, 'vendor_id');
        }

        // ------------------------------------------------
        // attributes

        protected function cancelledAt(): Attribute
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

        protected function scheduledStartAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }

        protected function scheduledEndAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }

        protected function onHoldAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }
    }
}
