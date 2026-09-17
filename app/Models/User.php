<?php

namespace App\Models {

    use Illuminate\Database\Eloquent\Attributes\ObservedBy;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Concerns\HasUuids;
    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Eloquent\Relations;
    use Illuminate\Notifications\Notifiable;
    use Spatie\Permission\Traits\HasRoles;
    use App\Observers\UserObserver;
    use Carbon\Carbon;

    #[ObservedBy(UserObserver::class)]
    /**
     * @method static where(string $where, string $is, ?string $operator = null)
     * @method static create(array $data)
     * @method static role(string $role)
     * @method static count(): int
     */
    class User extends Authenticatable
    {
        use SoftDeletes;
        use Notifiable;
        use HasFactory;
        use HasRoles;
        use HasUuids;

        /** @inheritdoc */
        protected $fillable = [
            'name',
            'email',
            'username',
            'password',
            'avatar',
        ];

        /** @inheritdoc */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        // ------------------------------------------------
        // casts

        /** @inheritdoc */
        protected function casts(): array
        {
            return [
                'email_verified_at' => 'datetime',
                'password'          => 'hashed',
            ];
        }

        // ------------------------------------------------
        // relations

        public function properties(): Relations\BelongsToMany
        {
            return $this->belongsToMany(Property::class)->withTimestamps();
        }

        public function assignedMakeReadyItems(): Relations\HasMany
        {
            return $this->hasMany(MakeReadyItem::class, 'assigned_to');
        }

        // ------------------------------------------------
        // attributes

        protected function createdAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }

        protected function updatedAt(): Attribute
        {
            return Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }
    }
}
