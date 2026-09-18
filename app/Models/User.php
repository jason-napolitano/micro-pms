<?php

namespace App\Models {

    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Storage;
    use Spatie\Permission\Traits\HasRoles;
    use Illuminate\Database\Eloquent;
    use Illuminate\Http\Request;
    use Carbon\Carbon;

    /**
     * @method static where(string $where, string $is, ?string $operator = null)
     * @method static create(array $data)
     * @method static role(string $role)
     * @method static count(): int
     */
    class User extends Authenticatable
    {
        use Eloquent\Factories\HasFactory;
        use Eloquent\Concerns\HasUuids;
        use Eloquent\SoftDeletes;
        use Notifiable;
        use HasRoles;

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

        public function properties(): Eloquent\Relations\BelongsToMany
        {
            return $this->belongsToMany(Property::class)->withTimestamps();
        }

        public function assignedMakeReadyItems(): Eloquent\Relations\HasMany
        {
            return $this->hasMany(MakeReadyItem::class, 'assigned_to');
        }

        // ------------------------------------------------
        // attributes

        protected function createdAt(): Eloquent\Casts\Attribute
        {
            return Eloquent\Casts\Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }

        protected function updatedAt(): Eloquent\Casts\Attribute
        {
            return Eloquent\Casts\Attribute::make(
                get: static fn ($value) => Carbon::parse($value)->format('M d, Y'),
            );
        }
    }
}
