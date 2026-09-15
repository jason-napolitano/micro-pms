<?php

namespace App\Models {

    use Illuminate\Database\Eloquent\Attributes\Fillable;
    use Illuminate\Database\Eloquent\Relations;

    #[Fillable(['address', 'image', 'phone', 'name', 'code'])]
    /**
     * @property array<MakeReady> $makeReadies
     * @property array<FloorPlan> $floorPlans
     * @property array<Unit> $units
     */
    class Property extends BaseModel
    {
        // ------------------------------------------------
        // relations
        public function users(): Relations\BelongsToMany
        {
            return $this->belongsToMany(User::class)->withTimestamps();
        }

        public function units(): Relations\HasMany
        {
            return $this->hasMany(Unit::class);
        }

        public function floorPlans(): Relations\HasMany
        {
            return $this->hasMany(FloorPlan::class);
        }

        public function makeReadies(): Relations\HasManyThrough
        {
            return $this->hasManyThrough(MakeReady::class, Unit::class);
        }

        // ------------------------------------------------
        // lifecycle hooks
        protected static function boot(): void
        {
            parent::boot();

            parent::creating(function ($model) {
                $model->code = strtoupper($model->code);
            });

            parent::updating(function ($model) {
                $model->code = strtoupper($model->code);
            });

            parent::deleting(function($model) {
                $model->floorPlans->each->delete();
            });
        }
    }
}
