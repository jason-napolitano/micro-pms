<?php

namespace App\Models {

    use Illuminate\Database\Eloquent\Relations;

    /**
     * @property Property $property
     * @property array<Unit> $units
     */
    class FloorPlan extends BaseModel
    {
        /** @inheritDoc **/
        protected $fillable = [
            'label',
            'bathrooms',
            'bedrooms',
            'property_id',
            'square_feet',
        ];

        // ------------------------------------------------
        // relations

        public function property(): Relations\BelongsTo
        {
            return $this->belongsTo(Property::class);
        }

        public function units(): Relations\HasMany
        {
            return $this->hasMany(Unit::class, 'floor_plan_id', 'id');
        }

        // ------------------------------------------------
        // lifecycle hooks

        protected static function boot(): void
        {
            parent::boot();
            parent::deleting(function($model) {
                $model->units->each->delete();
            });
        }
    }
}
