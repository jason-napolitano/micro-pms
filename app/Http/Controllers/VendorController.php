<?php

namespace App\Http\Controllers {

    use Illuminate\Support;
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
            if(auth()->user()->cannot('view_vendors')) {
                abort(403);
            }

            $vendors = Models\Vendor::withoutTrashed()->paginate(10);
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
            if(auth()->user()->cannot('view_vendor')) {
                abort(403);
            }

            return inertia('vendors/show', compact('vendor'));
        }

        public function store(Requests\Vendors\StoreVendor $request): Http\RedirectResponse
        {
            Models\Vendor::create($request->validated());

            return back();
        }

        /**
         * Delete a record from storage
         *
         * @param Models\Vendor $vendor
         *
         * @return Http\RedirectResponse
         */
        public function destroy(Models\Vendor $vendor): Http\RedirectResponse
        {
            $vendor->delete();
            return back();
        }
    }
}
