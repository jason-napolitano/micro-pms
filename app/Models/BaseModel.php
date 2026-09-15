<?php

namespace App\Models {

    use Illuminate\Database\Eloquent;
    use Carbon\Carbon;

    /**
     * @method static whereBetween(string $column, array $between)
     * @method static find(string|int $id)
     * @method static inRandomOrder()
     * @method static where($x, $y, ?$x)
     * @method static create($data)
     * @method static insert($data)
     * @method static first()
     */
    class BaseModel extends Eloquent\Model
    {
        use Eloquent\Factories\HasFactory;
        use Eloquent\Concerns\HasUuids;
        use Eloquent\SoftDeletes;

        // ------------------------------------------------
        // attributes

        protected function createdAt(): Eloquent\Casts\Attribute
        {
            return Eloquent\Casts\Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M j, Y'),
            );
        }

        protected function updatedAt(): Eloquent\Casts\Attribute
        {
            return Eloquent\Casts\Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M j, Y'),
            );
        }
    }
}
