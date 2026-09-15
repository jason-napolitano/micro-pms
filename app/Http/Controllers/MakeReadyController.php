<?php

namespace App\Http\Controllers {

    use App\Models\Enums\MakeReadyStatus;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades\DB;
    use App\Http\Requests\MakeReady;
    use Illuminate\Http\Request;
    use App\Http\Controllers;
    use Illuminate\Http;
    use App\Models;

    class MakeReadyController extends Controllers\Controller
    {
        /**
         * Store a newly created resource in storage.
         *
         * @param MakeReady\StoreMakeReady $request
         *
         * @return Http\RedirectResponse
         */
        public function store(MakeReady\StoreMakeReady $request): Http\RedirectResponse
        {
            // create new record
            $makeReady = Models\MakeReady::create($request->validated());

            // create make ready item types
            if ($makeReady) {
                foreach (Models\ItemType::withTrashed()->get() as $item) {
                    Models\MakeReadyItem::create([
                        'item_type_id'  => $item['id'],
                        'make_ready_id' => $makeReady['id'],
                    ]);
                }
            }

            // redirect
            return back();
        }

        /**
         * Update the status of a record
         *
         * @param MakeReady\UpdateStatus $request
         * @param Models\MakeReady       $makeReady
         *
         * @return RedirectResponse
         */
        public function updateStatus(MakeReady\UpdateStatus $request, Models\MakeReady $makeReady): RedirectResponse
        {
            // input validation
            $request->validated();

            // update the model
            if ($request['status'] === 'completed') {
                $makeReady['completed_at'] = now();
                $makeReady['status'] = MakeReadyStatus::COMPLETED;
            }
            if ($request['status'] === 'cancelled') {
                $makeReady['cancelled_at'] = now();
                $makeReady['status'] = MakeReadyStatus::CANCELLED;
            }
            if ($request['status'] === 'on_hold') {
                $makeReady['on_hold_at'] = now();
                $makeReady['status'] = MakeReadyStatus::ON_HOLD;
            }

            // save the data
            $makeReady->save();

            // redirect
            return back();
        }

        /**
         * Update the visibility of records
         *
         * @param Request $request
         *
         * @return RedirectResponse
         */
        public function updateVisibleItems(Request $request): RedirectResponse
        {
            // get the item type
            $type = Models\ItemType::withTrashed()->find($request['type'])->first();

            // toggle restore / delete
            if ($type['deleted_at']) {
                $type->restore();
            } else {
                $type->delete();
            }

            // redirect
            return back();
        }

        /**
         * Reorder the position of records
         *
         * @param Request $request
         *
         * @return RedirectResponse
         */
        public function reorder(Request $request): RedirectResponse
        {
            // input validation
            $validated = $request->validate([
                'items'   => ['required', 'array'],
                'items.*' => ['string', 'exists:item_types,id'],
            ]);

            // database transaction
            DB::transaction(function () use ($validated) {
                foreach ($validated['items'] as $index => $id) {
                    Models\ItemType::whereKey($id)->update([
                        'order' => $index + 1,
                    ]);
                }
            });

            // redirect
            return back();
        }
    }
}
