<?php

namespace App\Models {


    use Illuminate\Database\Eloquent\Attributes\Fillable;

    #[Fillable(['name', 'description', 'order'])]
    class ItemType extends BaseModel
    {
        public function casts(): array
        {
            return [
                'order' => 'integer',
            ];
        }
    }
}
