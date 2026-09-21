<?php

namespace App\Http\Actions\Properties {

    use Illuminate\Database;
    use App\Models\Property;

    class GetPropertyUnits
    {
        /**
         * Invoke the action
         *
         * @param Property $property
         *
         * @return Database\Eloquent\Collection
         */
        public function __invoke(Property $property): Database\Eloquent\Collection
        {
            return $property->units()->doesntHave('makeReady')->get();
        }

    }
}
