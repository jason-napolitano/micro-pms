<?php

namespace App\Http\Controllers {

	use App\Http\Requests\FloorPlans\StoreFloorPlan;
	use App\Models\FloorPlan;
	use Illuminate\Http\RedirectResponse;

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
            FloorPlan::create($request->all());

            // redirect
            return back();
        }

        /**
         * @param FloorPlan $floorPlan
         *
         * @return RedirectResponse
         */
        public function destroy(FloorPlan $floorPlan): RedirectResponse
        {
            $floorPlan->delete();
            return back();
        }
    }
}
