<?php

namespace App\Http\Controllers {

    use App\Http\Actions\Properties\GetMakeReadyUnits;
    use App\Http\Actions\Properties\GetPropertyUnits;
    use App\Http\Requests\Properties\StoreProperty;
    use Illuminate\Support\Facades\Storage;
    use Inertia\Response;
    use Illuminate\Http;
    use App\Models;

    class PropertyController extends Controller
    {
        public function index(): Response
        {
            if (auth()->user()->cannot('view_properties')) {
                abort(403);
            }

            /**
             * Show a list of resources
             *
             * @param Models\Property $property
             *
             * @return Response
             */
            $properties = user()->properties()->with(['units', 'floorPlans'])->paginate(10);
            return inertia('properties/index', compact('properties'));
        }

        /**
         * Show a single resource
         *
         * @param Models\Property $property
         *
         * @return Response
         */
        public function show(Models\Property $property): Response
        {
            if (auth()->user()->cannot('view', $property)) {
                abort(403);
            }

            return inertia('properties/show', [
                'makeReadyUnits'   => http_action(GetMakeReadyUnits::class, $property),
                'propertyUnits'    => http_action(GetPropertyUnits::class, $property),
                'tabUnits'         => $property->units()->with('floorPlan')->paginate(10, pageName: 'unitsPage'),
                'technicians'      => Models\User::withoutTrashed()->role('technician')->get(),
                'boardItemTypes'   => Models\ItemType::withoutTrashed()->orderBy('order')->get(),
                'vendors'          => Models\Vendor::withoutTrashed()->get(),
                'visibleItemTypes' => Models\ItemType::withTrashed()->orderBy('order')->get(),
                'floorPlans'       => $property->floorPlans,
                'property'         => $property,
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param StoreProperty $request
         *
         * @return RedirectResponse
         */
        public function store(StoreProperty $request): Http\RedirectResponse
        {
            if (auth()->user()->cannot('create_property')) {
                abort(403);
            }
            // create new record
            $record = Models\Property::create($request->validated());

            // attach all admin users
            $record->users()->attach(Models\User::role('admin')->get());

            try {
                $file = $request->file('image');
                $property = Models\Property::find($record->id);

                $path = '/storage/properties/' . $record->id;

                $property->update([
                    'image' => $path . '.' . $file->getClientOriginalExtension()
                ]);

                Storage::disk('public')->putFileAs('properties', $file, $record->id . '.' . $file->getClientOriginalExtension());
            } catch (\Throwable $e) {
                throw new \RuntimeException($e->getMessage());
            }

            // redirect
            return back();
        }

        /**
         * Removes a record from storage
         *
         * @param Models\Property $property
         *
         * @return RedirectResponse
         */
        public function destroy(Models\Property $property): Http\RedirectResponse
        {
            $property->delete();
            return back();
        }
    }
}
