<?php

namespace App\Http\Actions\Properties {

    use Illuminate\Database\Eloquent\Collection;
    use App\Models\Property;

    class GetMakeReadyUnits
	{
        public function __invoke(Property $property): Collection
        {
            return $property->units()
                ->whereHas('makeReady')
                ->with([
                    'makeReady.items' => fn($query) => $query
                        ->join(
                            'item_types',
                            'item_types.id',
                            '=',
                            'make_ready_items.item_type_id'
                        )
                        ->whereNull('item_types.deleted_at')
                        ->orderBy('item_types.order')
                        ->select('make_ready_items.*'),

                    'makeReady.items.assignee',
                    'makeReady.items.vendor',
                    'makeReady.items.type',
                    'floorPlan',
                ])->get();
        }
    }
}
