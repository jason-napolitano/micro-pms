<?php

namespace App\Models {

    use Illuminate\Database\Eloquent\Relations;

    /**
     * @property Property $property
     * @property MakeReady $makeReady
     * @property FloorPlan $floorPlan
     */
    class Unit extends BaseModel
    {
        /** @inheritdoc */
        protected $fillable = [
            'floor_plan_id',
            'property_id',
            'unit_number',
        ];

        // ------------------------------------------------
        // relations
        
        public function property(): Relations\BelongsTo
        {
            return $this->belongsTo(Property::class);
        }

        public function makeReady(): Relations\HasOne
        {
            return $this->hasOne(MakeReady::class);
        }

        public function floorPlan(): Relations\BelongsTo
        {
            return $this->belongsTo(FloorPlan::class);
        }
    }
}
