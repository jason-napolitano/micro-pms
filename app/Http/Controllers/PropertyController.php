<?php

namespace App\Http\Controllers {

    use App\Http\Actions\Properties\GetMakeReadyUnits;
    use App\Http\Actions\Properties\GetPropertyUnits;
    use App\Http\Requests\Properties\StoreProperty;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Gate;
    use Inertia\Response;
    use Illuminate\Http;
    use App\Models;

    class PropertyController extends Controller
    {
        /**
         * Display a list of resources
         *
         * @return Response
         */
        public function index(): Response
        {
            // authorization
            Gate::authorize('view_properties');

            // data
            $properties = user()->properties()->with(['units', 'floorPlans'])->paginate(10);

            // inertia response
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
            // authorization
            Gate::authorize('view', $property);

            // inertia response
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
         * @return Http\RedirectResponse
         */
        public function store(StoreProperty $request): Http\RedirectResponse
        {
            // authorization
            Gate::authorize('create_property');

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
         * @return Http\RedirectResponse
         */
        public function destroy(Models\Property $property): Http\RedirectResponse
        {
            // authorization
            Gate::authorize('delete', $property);

            // delete the record
            $property->delete();

            // redirect
            return back();
        }
    }
}
