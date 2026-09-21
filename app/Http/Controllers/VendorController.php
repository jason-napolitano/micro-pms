<?php

namespace App\Http\Controllers {

    use Illuminate\Support\Facades\Gate;
    use App\Http\Requests;
    use Inertia\Response;
    use Illuminate\Http;
    use App\Models;

    class VendorController extends Controller
    {
        /**
         * Display a list of resources
         *
         * @return Response
         */
        public function index(): Response
        {
            // authorization
            Gate::authorize('view_vendors');

            // data
            $vendors = Models\Vendor::withoutTrashed()->paginate(10);

            // inertia response
            return inertia('vendors/index', compact('vendors'));
        }

        /**
         * Display the specified resource.
         *
         * @param Models\Vendor $vendor
         *
         * @return Response
         */
        public function show(Models\Vendor $vendor): Response
        {
            // authorization
            Gate::authorize('view_vendor');

            // inertia response
            return inertia('vendors/show', compact('vendor'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Requests\Vendors\StoreVendor $request
         *
         * @return Http\RedirectResponse
         */
        public function store(Requests\Vendors\StoreVendor $request): Http\RedirectResponse
        {
            // authorization
            Gate::authorize('create_vendor');

            // create the record
            Models\Vendor::create($request->validated());

            // redirect
            return back();
        }

        /**
         * Removes a record from storage
         *
         * @param Models\Vendor $vendor
         *
         * @return Http\RedirectResponse
         */
        public function destroy(Models\Vendor $vendor): Http\RedirectResponse
        {
            // authorization
            Gate::authorize('delete_vendor');

            // delete the record
            $vendor->delete();

            // redirect
            return back();
        }
    }
}
