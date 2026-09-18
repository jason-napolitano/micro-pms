<?php

namespace App\Models {

    use Illuminate\Database\Eloquent\Attributes\Fillable;

    #[Fillable(['description', 'order', 'name'])]
    class ItemType extends BaseModel
    {
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
