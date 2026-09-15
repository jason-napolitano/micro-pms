<?php

namespace App\Http\Actions\Properties {

    use Illuminate\Database\Eloquent\Collection;
    use App\Models\Property;

    class GetPropertyUnits
	{
        public function __invoke(Property $property): Collection
        {
            return $property->units()->doesntHave('makeReady')->get();
        }

    }
}
