<?php

namespace App\Http\Controllers {

    use App\Http\Requests\MakeReady\UpdateStatus;
    use App\Http\Requests\Units\StoreUnit;
    use App\Models\Enums\MakeReadyStatus;
    use Illuminate\Http\RedirectResponse;
    use App\Models\MakeReady;
    use App\Models\Unit;

    class UnitController extends Controller
    {
        /**
         * Store a newly created resource in storage.
         *
         * @param StoreUnit $request
         *
         * @return RedirectResponse
         */
        public function store(StoreUnit $request): RedirectResponse
        {
            // create new record
            Unit::create($request->validated());

            // redirect
            return back();
        }

        /**
         * @param Unit $unit
         *
         * @return RedirectResponse
         */
        public function destroy(Unit $unit): RedirectResponse
        {
            $unit->delete();

            return back();
        }
    }
}
