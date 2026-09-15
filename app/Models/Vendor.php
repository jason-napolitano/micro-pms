<?php

namespace App\Models {

    use Illuminate\Database\Eloquent\Relations;

    /**
     * @property array<MakeReadyItem> $makeReadyItems
     */
    class Vendor extends BaseModel
    {
        /** @inheritdoc */
        protected $fillable = [
            'contact_name',
            'contact_phone',
            'contact_email',
            'phone',
            'email',
            'name',
        ];

        // ------------------------------------------------
        // casts

        /** @inheritdoc */
        protected function casts(): array
        {
            return [
                'active' => 'boolean',
            ];
        }

        // ------------------------------------------------
        // relations

        public function makeReadyItems(): Relations\HasMany
        {
            return $this->hasMany(MakeReadyItem::class);
        }
    }
}
