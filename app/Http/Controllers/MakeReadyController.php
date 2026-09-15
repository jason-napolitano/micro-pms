<?php

namespace App\Http\Controllers {

    use App\Http\Controllers;
    use App\Http\Requests\MakeReady;
    use App\Models;
    use App\Models\Enums\MakeReadyStatus;
    use Illuminate\Http;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

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

            // create new make ready item
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

        public function updateStatus(MakeReady\UpdateStatus $request, Models\MakeReady $makeReady): RedirectResponse
        {
            // input validation
            $request->validated();

            // update the model
            if ($request->status === 'completed') {
                $makeReady['completed_at'] = now();
                $makeReady['status'] = MakeReadyStatus::COMPLETED;
            }
            if ($request->status === 'cancelled') {
                $makeReady['cancelled_at'] = now();
                $makeReady['status'] = MakeReadyStatus::COMPLETED;
            }
            if ($request->status === 'on_hold') {
                $makeReady['on_hold_at'] = now();
                $makeReady['status'] = MakeReadyStatus::COMPLETED;
            }

            // save the data
            $makeReady->save();

            // redirect
            return back();
        }

        public function updateVisibleItems(Request $request): RedirectResponse
        {
            $type = Models\ItemType::withTrashed()->find($request['type'])->first();
            if ($type['deleted_at']) {
                $type->restore();
            } else {
                $type->delete();
            }

            return back();
        }

        /**
         * @return RedirectResponse
         */
        public function reorder(Request $request): RedirectResponse
        {
            $validated = $request->validate([
                'items'   => ['required', 'array'],
                'items.*' => ['string', 'exists:item_types,id'],
            ]);

            DB::transaction(function () use ($validated) {
                foreach ($validated['items'] as $index => $id) {
                    Models\ItemType::whereKey($id)->update([
                        'order' => $index + 1,
                    ]);
                }
            });


            return back();
        }
    }
}
