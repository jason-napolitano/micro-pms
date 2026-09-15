<?php

namespace App\Models {

    class ItemType extends BaseModel
    {
        /** @inheritdoc */
        protected $fillable = [
            'description',
            'order',
            'name',
        ];

        // ------------------------------------------------
        // casts
        /**
         * @inheritdoc
         */
        public function casts(): array
        {
            return [
                'order' => 'integer',
            ];
        }
    }
}
