<?php

namespace App\Http\Controllers {

    use App\Http\Requests\FloorPlans\StoreFloorPlan;
    use Illuminate\Http\RedirectResponse;
    use App\Models\FloorPlan;

    class FloorPlanController extends Controller
    {
        /**
         * Store a newly created resource in storage.
         *
         * @param StoreFloorPlan $request
         *
         * @return RedirectResponse
         */
        public function store(StoreFloorPlan $request): RedirectResponse
        {
            // create new record
            FloorPlan::create($request->validated());

            // redirect
            return back();
        }

        /**
         * Removes a record from storage
         *
         * @param FloorPlan $floorPlan
         *
         * @return RedirectResponse
         */
        public function destroy(FloorPlan $floorPlan): RedirectResponse
        {
            // delete the record
            $floorPlan->delete();

            // redirect
            return back();
        }
    }
}
